<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class taksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Seeder taks dapat sebagai default data taks
         * dengan role_as = 1 untuk menjadikan sebagai akun user 
        */
        DB::table('taks')->insert([
            'name'=>'Learning',
            'description'=>'1. Payment',
            'status'=>'1',
            'id_user'=>'1'
        ]);
    }
}
