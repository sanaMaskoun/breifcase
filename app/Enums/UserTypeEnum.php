<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserTypeEnum extends Enum
{
    const admin = 1;
    const lawyer = 2;
    const  translation_company = 3;
    const client = 4;
    
}
