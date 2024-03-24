<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RolesEnum extends Enum
{
    const Lawyer = 1;
    const legalConsultant = 2;
    const typingCenter = 3;
    const client = 4;
}
