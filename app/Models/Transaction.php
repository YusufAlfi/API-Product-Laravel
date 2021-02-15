<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Transaction extends Model
{
    //
    use softDeletes;
    protected $fillable = [
        'uuid', 'name', 'email', 'number', 'address', 'transaction_total', 'transaction_status'

    ];

    protected $hidden = [];

    // ini relasi ke transaction detail

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id');
    }

}
