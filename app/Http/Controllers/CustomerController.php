<?php

namespace App\Http\Controllers;

use App\Enums\GenderCustomer;
use App\Enums\TypeTransaction;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\ReportTransactionRequest;
use App\Http\Requests\TransactionRequest;
use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\Transaction;
use App\Repositories\Eloquent\EloquentTransactionRepository;
use App\Services\BankAccountService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function __construct(
        protected Customer $customer,
        protected Transaction $transaction,
        protected BankAccount $bankaccount,
        protected BankAccountService $bankAccountService,
        protected TransactionService $transactionService,
        protected EloquentTransactionRepository $repo,

    ) {
    }
    // public function index(Request $request, $id)
    // {
    //     $customer = $this->customer->findOrFail($id);

    //     $history = $this->transactionService->getInfoTrans($id);

    //     $deposit = 0;
    //     $withdraw = 0;

    //     $balance = 0;

    //     $accountIDs = $customer->account->pluck('id');

    //     $balance = $customer->account->sum('balance');

    //     if ($request->filled(['from', 'to'])) {


    //         $from = Carbon::parse($request->input('from'))->startOfDay();

    //         $to = Carbon::parse($request->input('to'))->endOfDay();


    //         [$deposit, $withdraw] = $this->bankAccountService->report($from, $to, $accountIDs);

    //     }

    //     return view('public.accounts.info.index', [
    //         'customer' => $customer,
    //         'history' => $history,
    //         'gender' => GenderCustomer::asSelectArray(),
    //         'deposit' => $deposit,
    //         'withdraw' => $withdraw,

    //         'balance' => $balance,
    //     ]);
    // }
    public function index(ReportTransactionRequest $request, $id)
    {
        try {
            $customer = $this->customer->findOrFail($id);

            $history = $this->transactionService->getInfoTrans($id);

            $balance = $customer->account->sum('balance');

            [$deposit, $withdraw] = $this->getTransactionSummary($request, $customer);

            return view('public.accounts.info.index', compact(
                'customer',
                'history',
                'deposit',
                'withdraw',
                'balance'
            ) + ['gender' => GenderCustomer::asSelectArray()]);

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Unable to load customer data');
        }
    }

    private function getTransactionSummary(ReportTransactionRequest $request, $customer): array
    {
        if (!$request->hasDateRange()) {
            return [0, 0];
        }

        [$from, $to] = $request->getDateRange();

        $accountIds = $customer->account->pluck('id');

        return $this->bankAccountService->report($from, $to, $accountIds);
    }


    public function update($id, CustomerRequest $request)
    {
        $data = $request->validated();

        $customer = $this->customer->findOrFail($id);

        $customer->update($data);

        return redirect()->back()->with('success', 'Cập nhật thành công!');

    }


}