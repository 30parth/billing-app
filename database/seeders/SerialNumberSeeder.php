<?php

namespace Database\Seeders;

use App\Models\BillSeries;
use Illuminate\Database\Seeder;

class SerialNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BillSeries::create([
            'prefix' => 'B_',
            'current' => '1',
        ]);
    }
}
