<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::all()->count() == 0) {
            User::create([
                'password' => Hash::make('Password'),
                'name' => 'Konstantin',
                'email' => 'konstmal@gmail.com',
                'token' => '4f7086e3cc00239ac8e20fcee23f3d05bbd6ff6b',
            ]);
        }
    }
}
