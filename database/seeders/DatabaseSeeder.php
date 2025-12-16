<?php

namespace Database\Seeders;

use App\Models\{Subscription, User};
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Вызываем новый Seeder
        $this->call(CurrencySeeder::class);

        // Создание тестового пользователя и подписки для демо
        User::factory()->create(['name' => 'Test User', 'email' => 'test@example.com']);
        Subscription::create([
            'user_id' => 1,
            'status' => 'pending',
            'plan_price' => 299.99,
            'ends_at' => Carbon::now()->addDays(7),
        ]);

    }
}
