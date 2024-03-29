<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use  HasUuids,HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class , 'permission_role');
    }
}
