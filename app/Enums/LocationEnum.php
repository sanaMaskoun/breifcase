<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class LocationEnum extends Enum
{
    const Dubai = 1;
    const Abu_Dhabi = 2;
    const Ajman = 3;
    const rak = 4;
    const Fujairah = 5;
    const UM_ALQ = 6;
    const al_ain = 7;
}
