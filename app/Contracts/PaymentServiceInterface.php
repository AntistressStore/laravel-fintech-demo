<?php

namespace App\Contracts;

use App\Models\Subscription;

interface PaymentServiceInterface
{
    public function charge(Subscription $subscription, float $amount): bool;

    public function cancel(Subscription $subscription): bool;
}
