<?php

namespace App\Models;

use App\Enums\GenderCustomer;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customers';

    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'id_citizen',
        'birth_day',
        'gender',
        'address',
        'password',
        'status',
    ];

    protected $hidden = ['password', 'remember_token'];


    protected $casts = [
        'gender' => GenderCustomer::class,
        'birth_day' => 'date'
    ];

    public function account()
    {
        return $this->hasMany(BankAccount::class, 'customer_id');
    }
}