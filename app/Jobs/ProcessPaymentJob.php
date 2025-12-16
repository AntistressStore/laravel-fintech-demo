<?php

namespace App\Jobs;

use App\Contracts\PaymentServiceInterface;
use App\Models\Subscription;
use App\Services\FintechLedgerService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\{InteractsWithQueue, SerializesModels};

class ProcessPaymentJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;
    public int $backoff = 60;

    // Внедрение модели в конструктор для безопасной сериализации
    public function __construct(
        public Subscription $subscription,
        public float $amount,
    ) {
    }

    // Внедрение Service Layers через метод handle
    public function handle(PaymentServiceInterface $paymentService, FintechLedgerService $ledgerService): void
    {
        // 1. Списание средств (Внешний API)
        $paymentSuccess = $paymentService->charge($this->subscription, $this->amount);

        if ($paymentSuccess) {

            // 2. Обновляем статус подписки
            $this->subscription->update([
                'status' => 'active',
                'ends_at' => now()->addMonth(),
            ]);

            // 3. Выполняем двойную запись (Финтех-логика)
            $ledgerService->recordPayment($this->subscription, $this->amount);

            // Здесь отправляется Real-time событие
            // broadcast(new SubscriptionRenewed($this->subscription));

        }
        // Логика обработки неудачи

    }
}
