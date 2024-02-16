<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkedSocialAccount extends Model
{
    use HasFactory;
    protected $fillable = ['provide_name','provide_id'];

    function user() {
        return $this->belongsTo(User::class);
    }
}
