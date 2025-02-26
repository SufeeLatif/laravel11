<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserModule;
use App\Models\UserAccessManages;
use App\Models\UserModules;

class UserModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserModule::truncate();

        $UserModule = array(

            /***************************** User **********************************/

            array('module_title' => 'user', 'module_slug' => 'userList', 'action_title' => 'List', 'module_parent' => 'User'),
            array('module_title' => 'user', 'module_slug' => 'userView', 'action_title' => 'View', 'module_parent' => 'User'),
            array('module_title' => 'user', 'module_slug' => 'userCreate', 'action_title' => 'Create', 'module_parent' => 'User'),
            array('module_title' => 'user', 'module_slug' => 'userUpdate', 'action_title' => 'Update', 'module_parent' => 'User'),
            array('module_title' => 'user', 'module_slug' => 'userDelete', 'action_title' => 'Delete', 'module_parent' => 'User'),

            /***************************** userRole **********************************/
            array('module_title' => 'userRole', 'module_slug' => 'userRoleList', 'action_title' => 'List', 'module_parent' => 'User Role'),
            array('module_title' => 'userRole', 'module_slug' => 'userRoleCreate', 'action_title' => 'Create', 'module_parent' => 'User Role'),
            array('module_title' => 'userRole', 'module_slug' => 'userRoleUpdate', 'action_title' => 'Update', 'module_parent' => 'User Role'),
            array('module_title' => 'userRole', 'module_slug' => 'userRoleDelete', 'action_title' => 'Delete', 'module_parent' => 'User Role'),

            
        );


        UserModule::insert($UserModule);

        $UserModules = UserModule::where('module_title', '!=', 'userRole')->get()->toArray();

        if (!empty($UserModules)) {
            if (!empty($UserModules)) {
                foreach ($UserModules as $key => $value) {

                    $UserAccessManagesArr = array(
                        'user_role_id' => 2,
                        'module_id' => $value['id'],
                    );


                    UserAccessManages::insert($UserAccessManagesArr);
                }
            }
        }

    }
}
