<?php

namespace App\Http\Controllers;

use App\Enums\TypeAccount;
use App\Http\Requests\BankAccountRequest;
use App\Http\Requests\TransactionRequest;
use App\Models\BankAccount;

use App\Services\BankAccountService;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    protected $service;
    protected $bankAccount;


    public function __construct(BankAccountService $service, BankAccount $bankAccount)
    {
        $this->service = $service;
        $this->bankAccount = $bankAccount;
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


    public function transfer(Request $request, $id)
    {

    }
}