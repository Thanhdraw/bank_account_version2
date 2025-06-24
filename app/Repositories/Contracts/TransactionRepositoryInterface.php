<?php

namespace App\Repositories\Contracts;

use App\Models\Transaction;

use DateTime;
use Illuminate\Support\Collection;

interface TransactionRepositoryInterface
{
    public function create(array $data): Transaction;
    public function report(DateTime $form, DateTime $to, Collection $id): Collection;
}