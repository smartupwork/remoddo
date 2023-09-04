<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

final class BrandConfirmationStatus extends Enum
{
    public const PENDING = 'pending';
    public const DECLINED = 'declined';
    public const CONFIRMED = 'confirmed';
}
