<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TransactionItemType extends Enum
{
    const ingredients =   0;
    const eatout =   1;
    const eachA =   2;
    const eachB =   3;
    const daily =   4;
    const entertainment = 5;
    const children =   6;
    const luxury =   7;
    const special = 8;
    const profits = 9;
    const loss =   10;
    const advanceA =   11;
    const advanceB = 12;
    

}
