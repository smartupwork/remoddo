<?php


namespace App\Repository\Main\Chat;

use App\Contract\Common\SelectDTOContract;
use App\DTO\DTOInterface;
use App\DTO\Main\SaveChatDTO;
use App\Models\ChatMessage;
use App\Models\Order;
use App\Repository\AbstractRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class SaveChatRepository extends AbstractRepository implements SelectDTOContract
{

    private Order $order;
    private DTOInterface $dto;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function executeQuery()
    {
        try {
            DB::beginTransaction();
            $dto = $this->getDTO();
            $chat = $this->order->chat()->updateOrCreate(['order_id' => $this->order->id]);

            $recipient_id=$this->order->renter_id;

            if ($this->order->lender_id!==auth()->user()->id){
                $recipient_id=$this->order->lender_id;
            }
            $chat->messages()->save(new ChatMessage([
                'message' => $dto->getMessage(),
                'user_id' => auth()->user()->id,
                'recipient_id' => $recipient_id,
            ]));
            $message_count=$chat->messages()
                ->where('is_read',false)
                ->where('recipient_id',$recipient_id)->count();
            DB::commit();
            return [$chat,$message_count];
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }


    }

    /**
     * @return SaveChatDTO
     */
    public function getDTO(): DTOInterface
    {
        return $this->dto;
    }

    public function setDTO(DTOInterface $dto)
    {
        $this->dto = $dto;
        return $this;
    }
}
