<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Bruno Barroso',
                'profile' => 'admin',
                'email' => 'brunobinfo@gmail.com',
                'registration'=>'007',
                'sector' => 'WEB',
                'role' => 'PROGRAMADOR',
                'password' =>bcrypt('123456')
            ],
        ]);
    }
}
