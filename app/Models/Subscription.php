<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'ends_at',
        'plan_price'
    ];

    protected $casts = [
        'ends_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Имитация связи Plan для демонстрации Resource
    public function plan()
    {
        return new class extends Model {
            public $name = 'Premium';
            public $price = 299.99;
        };
    }
}
