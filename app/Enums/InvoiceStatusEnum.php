<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class InvoiceStatusEnum extends Enum
{
    const accepte = 1;

    const pending = 2;
    const refund = 3;
}
