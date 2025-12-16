<?php

namespace App\Services;

use App\Models\{SettlementJournal, SettlementTransaction, Subscription};
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FintechLedgerService
{
    /**
     * Выполняет операцию двойной записи для платежа по подписке.
     */
    public function recordPayment(Subscription $subscription, float $amount, string $currencyId = 'RUB'): bool
    {
        // Обязательное использование транзакций для финансовой логики
        return DB::transaction(function () use ($subscription, $amount, $currencyId) {

            $journal = SettlementJournal::create([
                'type' => 'SUBSCRIPTION_RENEWAL',
                'code' => 'SUB-'.$subscription->id.'-'.Carbon::now()->timestamp,
                'description' => "Продление подписки #{$subscription->id}",
                'created_at' => Carbon::now(),
            ]);

            // Получение счетов (Счета должны быть созданы в Seeder)
            $accountCash = \App\Models\SettlementAccount::where('name', 'Cash')->firstOrFail();
            $accountRevenue = \App\models\SettlementAccount::where('name', 'Subscription Revenue')->firstOrFail();

            $value = (int) ($amount * 100);

            // Дебит: Увеличение актива (Деньги на расчетном счете)
            SettlementTransaction::create([
                'settlement_account_id' => $accountCash->id,
                'settlement_journal_id' => $journal->id,
                'currency_id' => $currencyId,
                'value' => $value,
                'created_at' => Carbon::now(),
            ]);

            // Кредит: Увеличение дохода (Выручка)
            SettlementTransaction::create([
                'settlement_account_id' => $accountRevenue->id,
                'settlement_journal_id' => $journal->id,
                'currency_id' => $currencyId,
                'value' => -$value,
                'created_at' => Carbon::now(),
            ]);

            return true;
        });
    }
}
