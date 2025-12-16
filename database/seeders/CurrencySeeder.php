<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('currencies')->insert([
            ['id' => 'RUB', 'name' => 'Российский рубль', 'symbol' => '₽', 'decimal_digits' => 2, 'fiat' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 'USD', 'name' => 'Доллар США', 'symbol' => '$', 'decimal_digits' => 2, 'fiat' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Посев счетов, необходимых для FintechLedgerService
        DB::table('settlement_accounts')->insert([
            ['name' => 'Cash', 'user_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Subscription Revenue', 'user_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
