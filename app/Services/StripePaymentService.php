<?php

namespace App\Services;

use App\Contracts\PaymentServiceInterface;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;

class StripePaymentService implements PaymentServiceInterface
{
    public function charge(Subscription $subscription, float $amount): bool
    {
        try {
            // Имитация интеграции с внешним API и успешной оплаты
            Log::info("Payment processed successfully for Subscription ID: {$subscription->id}, Amount: {$amount}");

            return true;
        } catch (\Exception $e) {
            Log::error("Payment failed for Subscription ID: {$subscription->id}. Error: ".$e->getMessage());

            return false;
        }
    }

    public function cancel(Subscription $subscription): bool
    {
        return true;
    }
}
