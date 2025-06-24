<?php

namespace App\Models;

use App\Traits\GenerateCodeTransaction;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    use GenerateCodeTransaction;
    protected $table = 'transactions';

    protected $fillable = ['transaction_code', 'from_account_id', 'to_account_id', 'type', 'amount', 'status', 'description', 'notes'];


    protected $casts = [
        'type' => \App\Enums\TypeTransaction::class,
        'status' => \App\Enums\StatusTransaction::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (empty($transaction->transaction_code)) {
                $transaction->transaction_code = $transaction->generateUniqueCodeTransaction(6);
            }
        });
    }


    public function fromAccount()
    {
        return $this->belongsTo(BankAccount::class, 'from_account_id');
    }

    public function toAccount()
    {
        return $this->belongsTo(BankAccount::class, 'to_account_id');
    }





}