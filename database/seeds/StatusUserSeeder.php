<?php

use Illuminate\Database\Seeder;

class StatusUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_statuses')->insert([
            [
                'status_user_name' => 'Aktif',
            ],
            [
                'status_user_name' => 'Non-Aktif',
            ],
        ]);
    }
}
