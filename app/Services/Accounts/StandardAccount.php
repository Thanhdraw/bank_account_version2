<?php

use App\Abstracts\BaseAccount;




class StandardAccount extends BaseAccount
{
    public function deposit(float $amount): float
    {
        $this->bankAccount->balance += $amount;
        $this->bankAccount->save();
        return $this->bankAccount->balance;
    }

    public function withdraw(float $amount): float
    {
        if ($this->bankAccount->balance < $amount) {
            throw new \Exception('Số dư không đủ');
        }

        $this->bankAccount->balance -= $amount;
        $this->bankAccount->save();
        return $this->bankAccount->balance;
    }
}