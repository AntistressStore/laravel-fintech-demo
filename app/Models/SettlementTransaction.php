<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettlementTransaction extends Model
{
    use HasFactory;

    public $timestamps = false; // Нет updated_at
    protected $guarded = ['id'];

    public function account()
    {
        return $this->belongsTo(SettlementAccount::class, 'settlement_account_id');
    }

    public function journal()
    {
        return $this->belongsTo(SettlementJournal::class, 'settlement_journal_id');
    }
}
