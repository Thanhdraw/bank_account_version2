<?php


namespace App\Traits;

trait GenerateCodeTransaction
{
    public function generateUniqueCodeTransaction($length = 6)
    {
        do {
            $code = strtoupper(bin2hex(random_bytes($length)));
        } while (self::where('transaction_code', $code)->exists());

        return $code;
    }

}