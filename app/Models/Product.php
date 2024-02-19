<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // protected $connection= 'second_db_connection';

    // protected $primaryKey = 'product_id';

    protected $fillable = [
        'name', 'description', 'price', 'created_by'
    ];
}
