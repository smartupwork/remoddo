<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;


final class OrderStatus extends Enum
{
    const NEW = 'new';
    const IS_COMING = 'is_coming';
    const IN_WARDROBE = 'in_wardrobe';
    const SHIPPED_BACK = 'shipped_back';
    const CONFIRM_SHIPPED_BACK = 'confirm_shipped_back';
    const ACCEPTED = 'accepted';
    const DECLINED = 'declined';
    const COMPLETED = 'completed';

    const FAILED = 'failed';
}
