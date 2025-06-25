<?php

namespace App\Http\Controllers;

use App\Enums\StatusTransaction;
use App\Enums\TypeAccount;
use App\Enums\TypeTransaction;
use App\Http\Requests\BankAccountRequest;
use App\Http\Requests\TransactionRequest;
use App\Http\Requests\TransferRequest;
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Services\BankAccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BankAccountController extends Controller
{
    protected $service;
    protected $bankAccount;

    protected $transaction;


    public function __construct(BankAccountService $service, BankAccount $bankAccount, Transaction $transaction)
    {
        $this->service = $service;
        $this->bankAccount = $bankAccount;
        $this->transaction = $transaction;
    }


    public function index()
    {
        $accounts = BankAccount::all();

        return view('public.accounts.index', compact('accounts'))->with('type', TypeAccount::asSelectArray());
    }

    public function create()
    {
        return view('public.accounts.create')

            ->with('type', TypeAccount::asSelectArray());
    }

    public function store(BankAccountRequest $request, BankAccountService $bankAccountService)
    {
        $data = $request->validated();


        $result = $bankAccountService->createAccountWithCustomer($data);

        if ($result['status'] === 'success') {

            return redirect()->route('accounts.index')

                ->with('success', $result['message']);
        }

        return redirect()->back()->with('error', $result['message']);
    }


    public function show($id)
    {
        $account = $this->bankAccount->findOrFail($id);

        $remiterInfo = $account->number_account;

        return view('public.accounts.show', compact('account', 'remiterInfo'));

    }

    public function deposit(TransactionRequest $request, $id)
    {
        $data = $request->validated();

        $account = $this->bankAccount->findOrFail($id);

        $result = $this->service->deposit($account, (float) $data['amount']);

        if ($result['status'] === 'success') {

            return redirect()->back()->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message']);

    }

    public function withdraw(TransactionRequest $request, $id)
    {
        $data = $request->validated();

        $account = $this->bankAccount->findOrFail($id);

        $result = $this->service->withdraw($account, (float) $data['amount']);

        if ($result['status'] === 'success') {

            return redirect()->back()->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message']);
    }


    public function transfer(TransferRequest $request, $transferAccount)
    {
        try {
            $data = $request->validated();

            $sender = $this->bankAccount->where('number_account', $transferAccount)->firstOrFail();

            if (!$this->checkPassTransfer($sender, $data['transaction_password'])) {

                return redirect()->back()->with('error', 'Invalid password');
            }

            $recieve = $this->bankAccount->where('number_account', $data['to_account_id'])->firstOrFail();

            if ($data['amount'] > $sender->balance) {

                return redirect()->back()->with('error', 'không đủ số dư để chuyển khoản');
            }

            $this->processTransfer($data, $sender, $recieve);

            return redirect()->back()->with('success', 'Chuyển khoản thành công');

        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    private function checkPassTransfer(BankAccount $bankAccount, $inputPassword): bool
    {
        return Hash::check($inputPassword, $bankAccount->password);
    }


    private function processTransfer($data, $sender, $recieve)
    {
        // Create transaction records, update balances
        DB::beginTransaction();
        try {

            $this->service->withdraw($sender, $data['amount']);

            $this->service->deposit($recieve, $data['amount']);

            $this->transaction->create([
                'from_account_id' => $sender->id,
                'to_account_id' => $recieve->id,
                'amount' => $data['amount'],
                'notes' => $data['notes'] ?? null,
                'type' => TypeTransaction::Transfer,
                'status' => StatusTransaction::Success,

            ]);

            DB::commit();


        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());

        }
    }

}