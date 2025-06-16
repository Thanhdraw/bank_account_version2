<?php

namespace App\Repositories\Contracts;
use App\Models\Customer;

interface CustomerRepositoryInterface
{
    public function create(array $data): Customer;
}