<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'transaction_date',
        'amount'
    ];

    protected $dates = [
        'transaction_date'
    ];

    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }
}
