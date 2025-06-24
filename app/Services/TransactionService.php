<?php

namespace App\Services;

use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\Transaction;

class TransactionService
{
    public function __construct(
        protected Transaction $transaction,
        protected Customer $customer
    ) {

    }

    public function getInfoTrans($id)
    {
        $customer = $this->customer->findOrFail($id);

        $accountID = $customer->account->pluck('id');

        $history = $this->transaction
            ->whereIn('from_account_id', $accountID)
            ->orderByDesc('created_at')
            ->get();

        return $history;
    }


}