<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $data;
    public int $sender_id;
    private Order $order;
    public int $notReadMessages;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $data, Order $order, int $sender_id,int $notReadMessages)
    {
        $this->data = $data;
        $this->sender_id = $sender_id;
        $this->order = $order;
        $this->notReadMessages = $notReadMessages;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('message-channel.' . $this->order->id);
    }

    public function broadcastAs()
    {
        return 'message-event';
    }
}
