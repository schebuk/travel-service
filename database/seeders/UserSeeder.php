<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'João Teste',
            'email' => 'joao@teste.com',
            'password' => bcrypt('senha_forte'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
