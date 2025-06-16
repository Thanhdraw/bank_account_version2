<?php


namespace App\Repositories\Contracts;


use App\Models\BankAccount;

interface BankAccountRepositoryInterface
{
    public function create(array $data): BankAccount;
}