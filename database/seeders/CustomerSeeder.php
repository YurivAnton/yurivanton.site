<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'name' => 'Firma_1 s r o',
                'address'  => 'Address firm 1',
                'city'  => 'City firm 1',
            ],
            [
                'name' => 'Firma_2 s r o',
                'address'  => 'Address firm 2',
                'city'  => 'City firm 2',
            ],
            [
                'name' => 'Firma_3 s r o',
                'address'  => 'Address firm 3',
                'city'  => 'City firm 3',
            ],
        ]);
    }
}
