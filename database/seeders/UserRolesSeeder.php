<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRoles;


class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRoles::truncate();

        $UserRoles = array(
            array(
                
                'title' => 'Super Admin',
                'status' => 1,

            ),
            
            array(
                
                'title' => 'Admin',
                'status' => 1,

            ),

            array(
                 
                'title' => 'User',
                'status' => 1,

            )
        );

        UserRoles::insert($UserRoles);


    }
}
