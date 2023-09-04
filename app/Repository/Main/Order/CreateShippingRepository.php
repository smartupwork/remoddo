<?php


namespace App\Repository\Main\Order;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Repository\AbstractRepository;

class CreateShippingRepository extends AbstractRepository
{

    private Order $order;
    private $shipping_data;

    public function __construct(Order $order, $shipping_data)
    {
        $this->order = $order;
        $this->shipping_data = $shipping_data;
    }


    public function executeQuery()
    {
        $address = new Address();
        $address_data = $this->shipping_data['address'];

        if (!$address_data['address_id']) {
            $address->setName($address_data['main_location'])
                ->setLocation($address_data['main_location'])
                ->setAdditionalLocation($address_data['additional_location'])
                ->setCountry($address_data['country'])
                ->setCity($address_data['city'])
                ->setPostCode($address_data['post_code'])
                ->setPhone($address_data['phone'])
                ->setUserId(auth()->user()->id)
                ->save();
            $address_data['address_id'] = $address->id;
        }

        $order_shipping = new OrderShipping();

        $order_shipping->name = $this->shipping_data['name'];
        $order_shipping->surname = $this->shipping_data['surname'];
        $order_shipping->address_id = $address_data['address_id'];
        $order_shipping->order_id = $this->order->id;
        $order_shipping->save();

    }
}
