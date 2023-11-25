<?php

namespace Database\Seeders;

use App\Models\Payment_description;
use Illuminate\Database\Seeder;

class AddNamesPaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = ['e-wallet', 'card'];
        for ($i = 1; $i <= 2; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                $payment = new Payment_description();
                $payment->payment_id = $i;
                $payment->language_id = $j;
                $payment->title = $payments[$i - 1];
                $payment->description = $payments[$i - 1];
                $payment->save();
            }
        }
    }
}
