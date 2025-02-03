<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhoisLookup extends Model {
    use HasFactory;

    protected $fillable = [
        'domain',
        'registrar',
        'owner',
        'owner_email',
        'country',
        'nameservers',
        'created_at_api',
        'expires_at',
    ];

    protected $casts = [
        'nameservers' => 'array',
        'created_at_api' => 'date',
        'expires_at' => 'date',
    ];
}