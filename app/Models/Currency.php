<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'symbol',
        'decimal_digits',
        'fiat',
    ];

    protected $casts = [
        'fiat' => 'boolean',
        'decimal_digits' => 'integer',
    ];
}
