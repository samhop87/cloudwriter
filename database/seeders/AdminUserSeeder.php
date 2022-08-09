<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => config('cloudwriter.admin.name'),
            'email' => config('cloudwriter.admin.email'),
            'password' => Hash::make(config('cloudwriter.admin.password')),
        ]);

        $role = Role::create(['name' => 'admin']);
        $user->assignRole('admin');
    }
}
