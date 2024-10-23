<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_totale',
        'les_prodact',
        'in_client',
        'in_user',
        'status'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'in_client');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'in_user');
    }
}