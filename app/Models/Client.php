<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'avatar',
        'email'
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class);
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

    public function fullName(){
        return ucwords($this->first_name . ' ' . $this->last_name);
    }

    public function getAvatar() : string
    {
        return asset(
            str_replace(
                'public',
                'storage',
                $this->avatar
            )
        );
    }
}
