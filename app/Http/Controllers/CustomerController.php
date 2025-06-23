<?php

namespace App\Http\Controllers;

use App\Enums\GenderCustomer;
use App\Enums\TypeTransaction;
use App\Http\Requests\CustomerRequest;
use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\Transaction;
use App\Repositories\Eloquent\EloquentTransactionRepository;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function __construct(
        protected Customer $customer,
        protected Transaction $transaction,
        protected BankAccount $bankaccount,
        protected TransactionService $transactionService,
        protected EloquentTransactionRepository $repo,

    ) {
    }
    public function index(Request $request, $id)
    {
        $customer = $this->customer->findOrFail($id);
        $history = $this->transactionService->getInfoTrans($id);

        $deposit = 0;
        $withdraw = 0;
        $data = collect(); // mặc định trống
        $balance = 0; // ✅ THÊM DÒNG NÀY

        if ($request->filled(['from', 'to'])) {
            $accountIDs = $customer->account->pluck('id'); 
            $balance = $customer->account->sum('balance'); 

            $from = Carbon::parse($request->input('from'))->startOfDay();
            $to = Carbon::parse($request->input('to'))->endOfDay();

            $data = $this->repo->report($from, $to, $accountIDs);

            foreach ($data as $transaction) {
                if ($transaction->type == TypeTransaction::Deposit) {
                    $deposit += $transaction->amount;
                } else {
                    $withdraw += $transaction->amount;
                }
            }
        }

        return view('public.accounts.info.index', [
            'customer' => $customer,
            'history' => $history,
            'gender' => GenderCustomer::asSelectArray(),
            'deposit' => $deposit,
            'withdraw' => $withdraw,
            'data' => $data,
            'balance' => $balance, // ✅ luôn tồn tại
        ]);
    }




    public function update($id, CustomerRequest $request)
    {
        $data = $request->validated();

        $customer = $this->customer->findOrFail($id);

        $customer->update($data);

        return redirect()->back()->with('success', 'Cập nhật thành công!');

    }


    // public function report(Request $request, $id)
    // {
    //     $customer = $this->customer->findOrFail($id);

    //     $accountIDs = $customer->account->pluck('id');

    //     $from = Carbon::parse($request->input('from'))->startOfDay();
    //     $to = Carbon::parse($request->input('to'))->endOfDay();

    //     $data = $this->repo->report($from, $to, $accountIDs);
    //     $deposit = 0;
    //     $withdraw = 0;
    //     // dd($data); 
    //     foreach ($data as $transaction) {
    //         if ($transaction->type == TypeTransaction::Deposit) {
    //             $deposit += $transaction->amount;
    //         } else {
    //             $withdraw += $transaction->amount;
    //         }
    //     }

    //     return view('public.accounts.info.index', [
    //         'customer' => $customer,
    //         'data' => $data,
    //         'deposit' => $deposit,
    //         'withdraw' => $withdraw,
    //     ]);


    // }




}