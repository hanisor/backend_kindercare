<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Caregiver;


class CaregiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Caregiver::factory()->create([
            'name' => 'shaufy yana',
            'ic_number' => '020405047896',
            'phone_number' => '0125547878',
            'email' => 'shao@gmail.com',
            'username' => 'shao',
            'password' => 'shao1234',
            'image' => '',
            'role' => 'CAREGIVER',
            'status' => 'ACTIVE'

        ]);
    }
}
