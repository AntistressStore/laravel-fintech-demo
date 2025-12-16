<?php

namespace App\Providers;

use App\Contracts\PaymentServiceInterface;
use App\Services\StripePaymentService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Inversion of Control: привязка интерфейса к конкретной реализации
        $this->app->bind(
            PaymentServiceInterface::class,
            StripePaymentService::class
        );
    }
}
