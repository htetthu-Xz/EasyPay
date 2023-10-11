<?php

namespace App\Helpers;

use App\Models\Transaction;
use App\Models\Wallet;

class  UuidGenerator {
    public static function GenerateAccountNumber() 
    {
        $number = mt_rand(1000000000000000, 9999999999999999);

        if(Wallet::where('account_number', $number)->exists()) {
            return self::GenerateAccountNumber();
        }

        return $number;
    }

    public static function GenerateRefNumber() 
    {
        $number = mt_rand(1000000000000000, 9999999999999999);

        if(Transaction::where('ref_no', $number)->exists()) {
            return self::GenerateRefNumber();
        }

        return $number;
    }

    public static function GenerateTransactionId() 
    {
        $number = mt_rand(1000000000000000, 9999999999999999);

        if(Transaction::where('trx_id', $number)->exists()) {
            return self::GenerateTransactionId();
        }

        return $number;
    }
}