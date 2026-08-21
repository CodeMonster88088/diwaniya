<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Diwaniya Admin',
            'email' => 'alawy_rose@hotmail.com',
            'password' => Hash::make('AdminOfDiwaniya123$'),
            'is_admin' => true,
        ]);
    }
}