<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;


final class NotificationType extends Enum
{
    const LATE_DISPATCH = 'late_dispatch';
    const SEND_BACK = 'send_back';
    const SEND_BACK_NOTIFY = 'send_back_notify';
    const RETURNED = 'returned';
    const PRODUCT_REQUESTED = 'product_requested';


    public static function converted_data()
    {
        return [
            self::LATE_DISPATCH=>'Late Dispatch',
            self::SEND_BACK=>'Send Your Order',
            self::SEND_BACK_NOTIFY=>'Order Send Back',
            self::RETURNED=>'Returned',
            self::PRODUCT_REQUESTED=>'Product Requested',
        ];
    }
}
