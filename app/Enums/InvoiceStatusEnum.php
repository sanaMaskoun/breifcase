<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class InvoiceStatusEnum extends Enum
{
    const pending = 1;

    const accepte = 1;
    const refund = 2;
}
