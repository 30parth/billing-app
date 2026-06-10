<?php

namespace Database\Seeders;

use App\Models\BillSeries;
use App\Models\User;
use Illuminate\Database\Seeder;

class SerialNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            BillSeries::create([
                'prefix' => 'B_',
                'current' => '1',
                'user_id' => $user->id,
            ]);
        }
    }
}
