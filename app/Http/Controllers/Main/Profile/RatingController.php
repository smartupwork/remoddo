<?php

namespace App\Http\Controllers\Main\Profile;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function add(Order $order,Request $request)
    {
        if ($request->get('rate_value')>0){
            $order->lender->rates()->create([
                'rate_value'=>$request->get('rate_value'),
                'order_id'=>$order->id,
            ]);
            return $this->jsonSuccess('lender rated');
        }else{
            return $this->jsonError('rating value should be greater than 0');
        }

    }
}
