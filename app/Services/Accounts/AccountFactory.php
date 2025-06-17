<?php 

namespace App\Services\Accounts;

use App\Enums\TypeAccount;
use App\Models\BankAccount;

class AccountFactory{
    public static function make(BankAccount $account){
         $type = $account->type;

        return match ($type) {
            TypeAccount::Standard => new StandardAccount($account),
            default => throw new \Exception('Loại tài khoản không hợp lệ'),
        };
    }
}