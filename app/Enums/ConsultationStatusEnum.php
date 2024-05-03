<?php declare (strict_types = 1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ConsultationStatusEnum extends Enum
{
    const ongoing = 1;

    const closed = 2;
    const pending = 3;
    const rejected = 4;
}
