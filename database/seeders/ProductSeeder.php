<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $products = [
            ['name' => 'બોક્સ વર્ક + ડીપ', 'price' => 140, 'description' => null],
            ['name' => 'ફ્રેમિંગ વર્ક', 'price' => 150, 'description' => null],
            ['name' => 'દરવાજો (ફ્લશ ડોર)', 'price' => 140, 'description' => null],
            ['name' => 'દરવાજો (સેન્ડવિચ ડોર)', 'price' => 150, 'description' => null],

            ['name' => 'મેન ડોર અથવા સેફ્ટી ડોર', 'price' => 200, 'description' => 'Range: 200-230'],
            ['name' => 'સોલિંગ', 'price' => 140, 'description' => 'Range: 140-200'],

            ['name' => 'ચેનલિંગ + ડીપ', 'price' => 140, 'description' => null],
            ['name' => 'ટીવી યુનિટ + ડીપ', 'price' => 140, 'description' => null],

            ['name' => 'ડ્રેવર અથવા કિચન સ્ટીલ બાસ્કેટ', 'price' => 400, 'description' => null],
            ['name' => 'ટેન્ડમ બાસ્કેટ', 'price' => 1000, 'description' => 'Range: 1000-1400'],

            ['name' => 'ઇનર લેમિનેટ', 'price' => 400, 'description' => null],
            ['name' => 'બેડ ટ્રોલી', 'price' => 2500, 'description' => null],

            ['name' => 'સાઇડ ટેબલ', 'price' => 2000, 'description' => 'Range: 2000-3000'],
            ['name' => 'સોફા સ્ટ્રક્ચર', 'price' => 400, 'description' => 'Range: 400-500'],

            ['name' => 'સ્ટડી ટેબલ + કોમ્પ્યુટર ટેબલ', 'price' => 2000, 'description' => null],
            ['name' => 'ડોર-બીડ (બારસાખ)', 'price' => 140, 'description' => null],

            ['name' => 'પલંગ', 'price' => 15000, 'description' => null],
            ['name' => 'કબાટ ટ્રોલી અથવા બાસ્કેટ', 'price' => 1000, 'description' => 'Range: 1000-1400'],
        ];

        DB::table('products')->insert($products);

    }
}
