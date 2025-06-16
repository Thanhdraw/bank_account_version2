<?php

namespace App\Models;

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

    public function account()
    {
        return $this->hasMany(BankAccount::class, 'customer_id');
    }
}