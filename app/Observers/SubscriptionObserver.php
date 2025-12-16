<?php

namespace App\Observers;

use App\Models\Subscription;
use Illuminate\Support\Facades\Log;

class SubscriptionObserver
{
    public function updated(Subscription $subscription): void
    {
        if ($subscription->wasChanged('status') && $subscription->status === 'active') {
            Log::info("Subscription #{$subscription->id} is now ACTIVE.");

            // Здесь бы мы отправляли Real-time уведомление (broadcast)
        }
    }
}
