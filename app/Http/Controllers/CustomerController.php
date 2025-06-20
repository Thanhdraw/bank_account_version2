<?php

namespace App\Http\Controllers;

use App\Enums\GenderCustomer;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Transaction;
use App\Services\TransactionService;

class CustomerController extends Controller
{
    public function __construct(
        protected Customer $customer,
        protected Transaction $transaction,
        protected TransactionService $transactionService
    ) {
    }
    public function index($id)
    {
        $customer = $this->customer->findOrFail($id);

        $history = $this->transactionService->getInfoTrans($id);

        return view('public.accounts.info.index', [
            'customer' => $customer,
            'history' => $history,
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