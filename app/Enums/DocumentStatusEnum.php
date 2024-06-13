<?php declare (strict_types = 1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DocumentStatusEnum extends Enum
{
    const pending = 1;
    const ongoing = 2;

    const closed = 3;
    const rejected = 4;
}
