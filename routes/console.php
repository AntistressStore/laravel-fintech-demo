<?php

use App\Console\Commands\SubscriptionRenewalCheck;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\{Artisan, Schedule};

Schedule::command(SubscriptionRenewalCheck::class)
    // Запускать ежедневно в 01:00 ночи
    ->dailyAt('01:00')
    // Добавьте логирование, чтобы видеть результат в логах
    ->onOneServer() // Гарантирует запуск только на одном сервере (важно для очередей и платежей)
    ->withoutOverlapping() // Гарантирует, что предыдущий запуск завершен
;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
