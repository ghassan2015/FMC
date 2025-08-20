<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Admin::query()->create([
            'name' => 'Haytiam Zedian',
            'email' => 'admin@example.com',
            'mobile' => '0567711720',
            'password' => '123456789',
            'password' => Hash::make('123456789'),

            'is_super' => 1,

        ]);
        Admin::query()->create([
            'name' => 'Haytiam Zedian',
            'email' => 'jawabreh@gmail.com',
            'mobile' => '0567711720',
            'password' => Hash::make('HaithamIsAdmin#1'),
            'is_super' => 1,

        ]);
    }
}
