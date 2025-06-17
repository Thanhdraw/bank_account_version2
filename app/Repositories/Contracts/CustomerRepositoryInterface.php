<?php

namespace App\Repositories\Contracts;
use App\Models\Customer;

interface CustomerRepositoryInterface
{
    public function create(array $data): Customer;

    public function update(array $data): Customer;
}