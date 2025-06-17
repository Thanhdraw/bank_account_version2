<?php

namespace App\Http\Controllers;

use App\Enums\GenderCustomer;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function __construct(protected Customer $customer)
    {
    }
    public function index($id)
    {
        $customer = $this->customer->findOrFail($id);

        return view('public.accounts.info.index', [
            'customer' => $customer,
            'gender' => GenderCustomer::asSelectArray(),
        ]);
    }


    public function update($id, CustomerRequest $request)
    {
        $data = $request->validated();

        $customer = $this->customer->findOrFail($id);

        $customer->update($data);

        return redirect()->back()->with('success', 'Cập nhật thành công!');

    }
}