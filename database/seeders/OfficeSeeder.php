<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offices')->insert([
            [
                'name' => 'Office_1 Firma_1 s r o',
                'address'  => 'Address office 1 firm 1',
                'city'  => 'City office 1 firm 1',
                'customer_id' => '1',
            ],
            [
                'name' => 'Office_2 Firma_1 s r o',
                'address'  => 'Address office 2 firm 1',
                'city'  => 'City office 2 firm 1',
                'customer_id' => '1',
            ],
            [
                'name' => 'Office_3 Firma_1 s r o',
                'address'  => 'Address office 3 firm 1',
                'city'  => 'City office 3 firm 1',
                'customer_id' => '1',
            ],
            [
                'name' => 'Office_1 Firma_2 s r o',
                'address'  => 'Address office 1 firm 2',
                'city'  => 'City office 1 firm 2',
                'customer_id' => '2',
            ],
            [
                'name' => 'Office_2 Firma_2 s r o',
                'address'  => 'Address office 2 firm 2',
                'city'  => 'City office 2 firm 2',
                'customer_id' => '2',
            ],
            [
                'name' => 'Office_1 Firma_3 s r o',
                'address'  => 'Address office 1 firm 3',
                'city'  => 'City office 1 firm 3',
                'customer_id' => '3',
            ],
        ]);
    }
}
