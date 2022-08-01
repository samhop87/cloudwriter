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
            'name' => config('brightwriter.admin.name'),
            'email' => config('brightwriter.admin.email'),
            'password' => Hash::make(config('brightwriter.admin.password')),
        ]);

        $role = Role::create(['name' => 'admin']);
        $user->assignRole('admin');
    }
}
