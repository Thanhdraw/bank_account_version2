<?php

namespace App\Repositories\Eloquent;

use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use DateTime;
use Illuminate\Support\Collection;



class EloquentTransactionRepository implements TransactionRepositoryInterface
{
    public function create(array $data): Transaction
    {
        return Transaction::create($data);
    }

    public function report(DateTime $from, DateTime $to, Collection $accountIDs): Collection
    {
        return Transaction::whereIn('from_account_id', $accountIDs)
            ->whereBetween('created_at', [
                $from->format('Y-m-d'),
                $to->format('Y-m-d')
            ])
            ->orderByDesc('created_at')
            ->get();
    }
}