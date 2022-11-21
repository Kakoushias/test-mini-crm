<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function transactionDate(): Attribute{
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->toDateTimeString()
        );
    }

    protected function createdAt(): Attribute{
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->toDateTimeString()
        );
    }

    protected function updatedAt(): Attribute{
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->toDateTimeString()
        );
    }
}
