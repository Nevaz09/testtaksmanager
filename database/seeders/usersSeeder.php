<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Seeder users dapat sebagai default data user
         * dengan role_as = 1 untuk menjadikan sebagai akun admin 
        */
        DB::table('users')->insert([
            'name'=>'Cindia Rama Auliansyah',
            'email'=>'cindiarama93@gmail.com',
            'password'=>bcrypt('pass'),
            'role_as'=>'1'
        ]);
    }
}
