<?php

use App\Models\SettlementAccount;
use App\Models\{Currency, SettlementJournal, User};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('settlement_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SettlementAccount::class)->constrained();
            $table->foreignIdFor(SettlementJournal::class)->constrained();
            $table->string('currency_id', 4);
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->string('settlement_period', 100)->nullable();
            $table->bigInteger('value');
            $table->timestamp('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settlement_transactions');
    }
};
