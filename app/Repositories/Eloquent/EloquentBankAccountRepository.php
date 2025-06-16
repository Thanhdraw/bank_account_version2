<?php

namespace App\Repositories\Eloquent;
use App\Models\BankAccount;
use App\Repositories\Contracts\BankAccountRepositoryInterface;



class EloquentBankAccountRepository implements BankAccountRepositoryInterface
{
    public function create(array $data): BankAccount
    {
        return BankAccount::create($data);
    }
}