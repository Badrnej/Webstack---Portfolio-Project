<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'qaliti',
        'price',
        'in_category',
        'in_fournisseur',
        'image',
        'in_user'
    ];
}
