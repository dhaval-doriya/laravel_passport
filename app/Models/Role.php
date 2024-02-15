<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasUuids,HasFactory;

    public $timestamps = false;


    protected $fillable = [
        'name'
    ];

    public function permission()
    {
        return $this->belongsToMany(Permission::class , 'permission_role');
    }

    
}
