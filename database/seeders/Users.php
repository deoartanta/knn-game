<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('admin123'),
            'level'=>'1',
        ]);
        $valRan = Str::random(1);
        DB::table('users')->insert([
            'name'=>'User '.Str::upper($valRan),
            'email'=>Str::lower($valRan).'user@gmail.com',
            'password'=>Hash::make(Str::lower($valRan).'user123'),
            'level'=>'0',
        ]);
    }
}
