<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Mr.Admin',
            'type_user'=>'admin',
            'email'=>'admin@crash.com',
            'password'=>bcrypt('admin1234#'),
            ]);
        User::create([
            'name'=>'Mr.Recipients Employee',
            'type_user'=>'hrd',
            'email'=>'recipientsemployee@crash.com',
            'password'=>bcrypt('recipientsemployee1234#'),
            ]);
        User::create([
            'name'=>'MR.Treasurer',
            'type_user'=>'bendahara',
            'email'=>'treasurer@crash.com',
            'password'=>bcrypt('treasurer1234#'),
            ]);
    }
}
