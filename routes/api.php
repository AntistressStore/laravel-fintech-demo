<?php

use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'as' => 'api.',
    'middleware' => ['auth:sanctum'],
], function () {
    // GET /v1/subscriptions/{subscription}
    Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show'])
        ->name('subscriptions.show')
    ;

    // POST /v1/subscriptions/{subscription}/charge
    Route::post('/subscriptions/{subscription}/charge', [SubscriptionController::class, 'processPayment'])
        ->name('subscriptions.charge')
    ;
});
