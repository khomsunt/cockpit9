<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user=new \App\User();
        $user->name='Khomkrit Kaewma';
        $user->email='gggg@gmail.com';
        $user->password=Hash::make('123456');
        $user->save();
    }
}
