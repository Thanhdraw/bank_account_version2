<?php


namespace App\Abstracts;

use App\Models\BankAccount;

abstract class BaseAccount
{
    protected BankAccount $bankAccount;

    public function __construct(BankAccount $bankAccount)
    {
        $this->bankAccount = $bankAccount;
    }

    abstract public function deposit(float $amount): float;

    abstract public function withdraw(float $amount): float;


    public function getBalance(): float
    {
        return $this->bankAccount->balance ?? 0;
    }
}