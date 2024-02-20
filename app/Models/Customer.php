<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Customer extends Model
{
    use HasFactory,HasUuids, Billable;

    protected $fillable = [
        'name', 'email', 'profile_picture' ,'password'
    ];
}
