<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;


final class UserType extends Enum
{
    const ADMIN = 'admin';
    const RENTER = 'renter';
    const LENDER = 'lender';
    const SUPPORTAGENT = 'support_agent';
}
