<?php

namespace App\Console\Commands;

use App\Jobs\ProcessPaymentJob;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SubscriptionRenewalCheck extends Command
{
    protected $signature = 'subscriptions:check-renewal';
    protected $description = 'Checks for subscriptions due for renewal and dispatches payment jobs.';

    public function handle(): int
    {
        $tomorrow = Carbon::now()->addDay()->toDateString();

        $subscriptions = Subscription::where('status', 'active')
            ->whereDate('ends_at', $tomorrow)
            ->get()
        ;

        $this->line("Found {$subscriptions->count()} subscriptions due for renewal.");

        foreach ($subscriptions as $subscription) {
            ProcessPaymentJob::dispatch($subscription, $subscription->plan_price);
        }

        return Command::SUCCESS;
    }
}
