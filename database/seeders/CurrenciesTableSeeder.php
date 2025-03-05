<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::truncate();

        Currency::create([
            'name' => 'Dólar estadounidense',
            'symbol' => 'USD',
            'exchange_rate' => 1
        ]);

        Currency::create([
            'name' => 'Euro',
            'symbol' => 'EUR',
            'exchange_rate' => 0.85
        ]);

        Currency::create([
            'name' => 'Peso mexicano',
            'symbol' => 'MXN',
            'exchange_rate' => 20.5
        ]);

        Currency::create([
            'name' => 'Peso dominicano',
            'symbol' => 'DOP',
            'exchange_rate' => 62.45
        ]);
    }
}
