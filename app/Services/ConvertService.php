<?php


namespace App\Services;


use App\Facades\Options;
use App\Option;
use App\User;

class ConvertService
{
    public static function convertBonuses(): bool {
        $user = User::where('id', auth()->user()->id)->first();

        if (!self::calculateRatio($user->bonuses)) {
            return false;
        }

        self::updateBalance(Options::getRatio() * $user->bonuses);
        $user = User::where('id', auth()->user()->id)->first();
        $user->bonuses = 0;
        $user->save();
        return true;
    }

    public static function calculateRatio($bonuses): bool {
        return Options::calculateBalance(Options::getRatio() * $bonuses);
    }

    /**
     * @param $value
     * @return bool
     */
    public static function updateBalance($value): bool {
        if (!Options::calculateBalance($value))
            return false;

        $option = Option::where('name', Options::getServiceBalance())->first();
        $option->value = $option->value - $value;
        $option->save();

        self::updateProfile($value, true);
        return true;
    }

    /**
     * @param $value
     * @param bool $is_balance
     */
    public static function updateProfile($value, $is_balance = false) {
        $user = User::where('id', auth()->user()->id)->first();
        if ($is_balance) {
            $user->balance = $user->balance + $value;
        } else {
            $user->bonuses = $user->bonuses + $value;
        }
        $user->save();
    }
}