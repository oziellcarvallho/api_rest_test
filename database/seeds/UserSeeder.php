<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'type' => 'super_admin'
        ],[ 'password' => Hash::make('123456') ]);

        User::firstOrCreate([
            'name' => 'Gerente Teste',
            'email' => 'gerente@teste.com',
            'type' => 'manager'
        ],[ 'password' => Hash::make('123456') ]);

        User::firstOrCreate([
            'name' => 'Executor Teste',
            'email' => 'executor@teste.com',
            'type' => 'executioner'
        ],[ 'password' => Hash::make('123456') ]);
    }
}
