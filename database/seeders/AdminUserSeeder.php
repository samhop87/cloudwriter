<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => config('brightwriter.admin.name'),
            'email' => config('brightwriter.admin.email'),
            'password' => Hash::make(config('brightwriter.admin.password')),
        ]);
    }
}
