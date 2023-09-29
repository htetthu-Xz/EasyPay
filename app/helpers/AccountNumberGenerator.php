<?php

namespace App\Helpers;

use App\Models\Wallet;

class  AccountNumberGenerator {
    public static function GenerateNumber() 
    {
        $number = mt_rand(1000000000000000, 9999999999999999);

        if(Wallet::where('account_number', $number)->exists()) {
            return self::GenerateNumber();
        }

        return $number;
    }
}