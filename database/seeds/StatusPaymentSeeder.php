<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_statuses')->insert([
            [
                'payment_status_name' => 'Menunggu Pembayaran',
            ],
            [
                'payment_status_name' => 'Sukses',
            ],
            [
                'payment_status_name' => 'Batal',
            ]
        ]);
    }
}
