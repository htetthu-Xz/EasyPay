<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminUser::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '123123123',
            'phone' => '09988345323'
        ]);
    }
}
