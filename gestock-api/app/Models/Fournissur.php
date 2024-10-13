<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournissur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'email',
        'phone',
        'address'
    ];
}
