<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class TravelRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('travel_requests')->insert([
            'id' => Str::uuid(),
            'user_id' => 1,
            'requester_name' => 'João Teste',
            'destination' => 'Lisboa',
            'departure_date' => now()->addDays(3)->toDateString(),
            'return_date' => now()->addDays(10)->toDateString(),
            'status' => 'solicitado',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
