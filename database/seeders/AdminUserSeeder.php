<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'password' => config('brightwriter.admin.password'),
        ]);
    }
}
