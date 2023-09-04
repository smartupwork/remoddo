<?php

namespace App\Http\Controllers\Main\Profile;

use App\DTO\Main\SaveChatDTO;
use App\Enums\ConversationType;
use App\Enums\OrderStatus;
use App\Enums\UserType;
use App\Events\GetNotReadMessageCountEvent;
use App\Events\SendMessage;
use App\Handler\Command\Main\Chat\SaveChatHandler;
use App\Handler\Service\HandlerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\DisputeRequest;
use App\Http\Requests\Main\ChatRequest;
use App\Models\Chat;
use App\Models\DisputeCategory;
use App\Models\Order;
use App\Models\SupportAgent;
use Illuminate\Http\Request;


class ChatController extends Controller
{
    private SaveChatDTO $dto;
    private HandlerService $handlerService;

    public function __construct(SaveChatDTO $dto, HandlerService $handlerService)
    {
        $this->dto = $dto;
        $this->handlerService = $handlerService;
    }

    public function index()
    {
        $renter = [];
        $user_id = auth()->user()->id;
        $chat = Chat::with(['messages.user'])
            ->whereHas('messages', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->orWhereHas('order', function ($query) use ($user_id) {
                $query->where('lender_id', $user_id)
                    ->orWhere('renter_id', $user_id);
            })
            ->orderByDesc('id')->first();

        if (!$chat) {
            return view('main.pages.profile.chat.not-message');
        }
        return redirect()->route('main.profile.chat.edit', ['order' => $chat->order_id]);
    }


    public function edit(Order $order)
    {
        $user_id = auth()->user()->id;
        $renter = $order->renter;

        $order->chat()->firstOrCreate([
            'order_id' => $order->id
        ]);

        $chats = Chat::with(['messages.user','messages.disputes'])
            ->whereHas('messages', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->orWhereHas('order', function ($query) use ($user_id) {
                $query->where('lender_id', $user_id)
                    ->orWhere('renter_id', $user_id);
            })
            ->get();


        if ($chats->count() == 0) {
            return redirect()->back();
        }

        $selected_chat = $order->chat;
        $pusher_key = config('broadcasting.connections.pusher.key');

        if ($order->chat->messages()->exists() && auth()->id() == $order->chat->last_message->recipient_id) {
            $order->chat->messages()->where('is_read', false)->update([
                'is_read' => true
            ]);
        }

        $problems = DisputeCategory::get();

        return view('main.pages.profile.chat.index', compact(
            'renter', 'order', 'chats', 'selected_chat', 'pusher_key', 'problems'
        ));
    }

    public function store(Order $order, ChatRequest $request)
    {
        $dto = $this->dto->make($request);
        $handler = $this->handlerService->setHandler(new SaveChatHandler($order))->getHandler();
        [$chat, $message_count] = $handler->setDTO($dto)->setModel(new Chat)->handle();
        $message = $chat->last_message;
        $last_message = [
            'hour' => $message->hour,
            'message' => $message->message,
            'full_name' => $message->user->info->full_name,
            'avatar' => $message->user->info->avatar,
        ];

        event(new SendMessage($last_message, $order, auth()->user()->id, $message_count));
        event(new GetNotReadMessageCountEvent($message->recipient->id, $message_count));

        return $this->jsonSuccess('', [
            'last_message' => $last_message
        ]);
    }

    public function delete(Order $order)
    {
        if (in_array($order->status, [OrderStatus::DECLINED, OrderStatus::FAILED])) {
            $order->chat->delete();
        }
        return redirect()->route('main.profile.lender.overview');
    }


    public function search(Request $request, ?Order $order = null)
    {
        $q = $request->get('q');
        $chats = Chat::with('messages.recipient.info:name,surname,user_id')
            ->orWhereHas('messages.recipient.info', function ($query) use ($q) {
                $query->where('name', 'like', "%$q%")->orWhere('surname', 'like', "%$q%");
            })
            ->get();

        $chat_data = [];

        foreach ($chats as $chat) {
            $chat_data[] = [
                'full_name' => $chat->last_message->opposite_side_user->info->full_name,
                'order_id' => $chat->order_id,
                'not_read_message_count' => $chat->not_read_message_count,
                'active' => $order && $chat->order_id == $order->id,
                'url' => route('main.profile.chat.edit', $order)
            ];
        }

        return $this->jsonSuccess('', [
            'chats' => $chat_data
        ]);
    }

    public function disputeSearch(Request $request)
    {
        $q = $request->get('q');
        $chats = Chat::with('messages.recipient.info:name,surname,user_id')
            ->whereHas('messages.disputes')
            ->orWhereHas('messages.recipient.info', function ($query) use ($q) {
                $query->where('name', 'like', "%$q%")->orWhere('surname', 'like', "%$q%");
            })
            ->get();

        $chat_data = [];

        foreach ($chats as $chat) {
            $chat_data[] = [
                'full_name' => $chat->last_message->opposite_side_user->info->full_name,
                'order_id' => $chat->order_id,
                'not_read_message_count' => $chat->not_read_message_count,
                'active' => false,
                'url' => route('support.chatsProblems', $chat)
            ];
        }

        return $this->jsonSuccess('', [
            'chats' => $chat_data
        ]);
    }

    public function messageRead(Order $order)
    {
        $user = auth()->user();
        $order->chat->messages()
            ->where('recipient_id', $user->id)
            ->update([
                'is_read' => true
            ]);

        return $this->jsonSuccess('', [
            'messages_count' => $user->notReadMessages->count()
        ]);
    }

    public function dispute(Chat $chat, DisputeRequest $request)
    {
//        if (auth()->id() != $chat->order->renter_id || auth()->id() != $chat->order->lender_id) {
//            abort(403);
//        }
        $recipient_id = $chat->order->renter_id;
        if ($chat->order->lender_id !== auth()->id()) {
            $recipient_id = $chat->order->lender_id;
        }
        $setting = \App\Models\Setting::get('support_default_message');

        $dispute = DisputeCategory::find($request->get('reason_inp'));

        $message = $setting && $dispute
            ? str_replace("{{dispute_category}}", ucfirst($dispute->title), $setting)
            : 'Hi, my name Jack Smith. I’m your support manager. You have opened dispute about Returning Money. Please, describe your situation and how can I help you?';

        $dispute_msg = $chat->messages()->create([
            'message' => $message,
            'user_id' => auth()->id(),
            'type' => ConversationType::DISPUTE,
            'recipient_id' => $recipient_id,
        ]);

        $agent =  SupportAgent::with('info')->whereHas('statusJob', function ($query) {
            $query->where('status_job',true);
        })->first() ?? SupportAgent::with('info')->inRandomOrder()->first();
        $dispute_msg->disputes()->attach($request->get('reason_inp'),
            ['support_agent_id' => $agent->id,'full_name_agent'=>$agent->info->full_name]);

        return $this->jsonSuccess('Success');

    }

    public function chatsProblems(?Chat $chat = null)
    {
        $chats = Chat::with(['messages.user.info', 'order.renter.info', 'order.product','messages.disputes'])
            ->whereHas('messages', function ($query) {
                $query->whereHas('disputes');
            })
            ->get();

        $selected_chat = $chats->first();
        if ($chat) {
            $selected_chat = $chat;
        }
        if (auth()->user()->checkRole(UserType::ADMIN)){
            $agent_status = false;
            $is_admin = true;
        }else{
            $agent_status = SupportAgent::find(auth()->id())->statusJob->status_job;
            $is_admin = false;
        }
        $pusher_key = config('broadcasting.connections.pusher.key');
        return view('main.pages.profile.chat.index-support-agent', compact(
            'chats', 'selected_chat', 'pusher_key','agent_status','is_admin'
        ));
    }
}
