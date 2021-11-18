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
    const ingredients =  0;
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
    
     public static function getDescription($value): string
    {
        if ($value === self::ingredients) {
            return '食材費';
        }

        if ($value === self::eatout) {
            return '外食費';
        }

        if ($value === self::eachA) {
            return '個別A';
        }
        if ($value === self::eachB) {
            return '個別B';
        }

        if ($value === self::daily) {
            return '日用費';
        }

        if ($value === self::entertainment) {
            return '交際費';
        }
        if ($value === self::children) {
            return '養育費';
        }

        if ($value === self::luxury) {
            return '贅沢費';
        }

        if ($value === self::special) {
            return '特別費';
        }
        if ($value === self::profits) {
            return '雑益';
        }

        if ($value === self::loss) {
            return '雑損';
        }

        if ($value === self::advanceA) {
            return '立替A';
        }

        if ($value === self::advanceB) {
            return '立替B';
        }

        return parent::getDescription($value);
    }

    public static function getValue(string $key)
    {
        if ($key === '食材費') {
            return self::MANAGEMENT;
        }

        if ($key === '外食費') {
            return self::HUMAN_RESOURCE;
        }

        if ($key === '個別A') {
            return self::INFORMATION_SYSTEM;
        }
        if ($key === '個別B') {
            return self::MANAGEMENT;
        }

        if ($key === '日用費') {
            return self::HUMAN_RESOURCE;
        }

        if ($key === '交際費') {
            return self::INFORMATION_SYSTEM;
        }
        if ($key === '養育費') {
            return self::MANAGEMENT;
        }

        if ($key === '贅沢費') {
            return self::HUMAN_RESOURCE;
        }

        if ($key === '特別費') {
            return self::INFORMATION_SYSTEM;
        }
        if ($key === '雑益') {
            return self::MANAGEMENT;
        }

        if ($key === '雑損') {
            return self::HUMAN_RESOURCE;
        }

        if ($key === '立替A') {
            return self::INFORMATION_SYSTEM;
        }
        if ($key === '立替B') {
            return self::MANAGEMENT;
        }

        return parent::getValue($key);
    }
}