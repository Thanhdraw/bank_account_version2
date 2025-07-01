<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BankAccountController extends Controller
{
    public function index($name)
    {

        $accounts = DB::table('transactions')
            ->select('status', DB::raw('count(*) as total'))
            ->groupby('status')
            ->get();
        return response()->json($accounts);
    }
}