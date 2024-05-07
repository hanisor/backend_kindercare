<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guardian;


class GuardianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guardian::factory()->create([
            'name' => 'hanis sorhana',
            'ic_number' => '021217140359',
            'phone_number' => '01111940358',
            'email' => 'hanisor@gmail.com',
            'username' => 'sorsor',
            'password' => 'hanis1234',
            'image' => '',
            'role' => 'PARENT',
            'status' => 'ACTIVE'

        ]);
    }
}
