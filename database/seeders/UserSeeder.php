<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'role_id'         => Role::where('slug','admin')->first()->id,
            'name'            => 'Admin',
            'email'           => 'admin@gmail.com',
            'password'        => Hash::make(123456789),
            'status'          => true
        ]);

        User::updateOrCreate([
            'role_id'         => Role::where('slug','user')->first()->id,
            'name'            => 'User',
            'email'           => 'user@gmail.com',
            'password'        => Hash::make(123456789),
             'status'         => false
        ]);
    }
}
