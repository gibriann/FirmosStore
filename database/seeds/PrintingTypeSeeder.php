<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PrintingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('printing_types')->insert([
            [
                'printing_name' => 'Plastisol',
            ],
            [
                'printing_name' => 'Polyflex',
            ],
            [
                'printing_name' => 'DTG',
            ],
            [
                'printing_name' => 'DTF',
            ]
        ]);
    }
}
