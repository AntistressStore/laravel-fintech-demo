<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubscriptionResource;
use App\Jobs\ProcessPaymentJob;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    public function show(Subscription $subscription): SubscriptionResource
    {
        return new SubscriptionResource($subscription);
    }

    public function processPayment(Subscription $subscription): JsonResponse
    {
        // Диспетчеризация Job для выполнения тяжелой работы в очереди
        ProcessPaymentJob::dispatch($subscription, $subscription->plan_price);

        return response()->json([
            'message' => 'Платеж принят в обработку. Статус обновится асинхронно.',
            'subscription_id' => $subscription->id,
        ], 202);

    }
}
