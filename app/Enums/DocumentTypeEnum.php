<?php declare (strict_types = 1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DocumentTypeEnum extends Enum
{
    const consultation = 1;
    const case = 2;
    const translate = 3;

}
