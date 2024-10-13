<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commende extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'lest_product',
        'in_client',
        'in_user'
    ];
}
