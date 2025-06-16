<?php


namespace App\Repositories\Eloquent;
use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;

class EloquentCustomerRepository implements CustomerRepositoryInterface
{
    public function create(array $data): Customer
    {
        return Customer::create($data);
    }
}