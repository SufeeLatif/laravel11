<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $adminRecords = array(
            array(

                'first_name' => 'Sufee',
                'last_name' => 'Latif',
                'name' => 'sufee-latif',
                'user_type' => 1,
                'mobile' => '+923242193100',
                'email' => 'sufeedeveloper@gmail.com',
                'password' => bcrypt(123456),
                'image' => 'default.jpg',
                'status' => 1,
                'unique_in' => Str::lower(implode('-', str_split(Str::random(16), 4))),

            ),

            array(

                'first_name' => 'Super',
                'last_name' => 'Admin',
                'name' => 'super-admin',
                'user_type' => 1,
                'mobile' => '+923242193100',
                'email' => 'admin@admin.com',
                'password' => bcrypt(123456),
                'image' => 'default.jpg',
                'status' => 1,
                'unique_in' => Str::lower(implode('-', str_split(Str::random(16), 4))),


            ),

            array(

                'first_name' => 'Sufee',
                'last_name' => 'Developer',
                'name' => 'sufee-developer',
                'user_type' => 3,
                'mobile' => '+923242193100',
                'email' => 'sufeedeveloper@outlook.com',
                'password' => bcrypt(123456),
                'image' => 'default.jpg',
                'status' => 1,
                'unique_in' => Str::lower(implode('-', str_split(Str::random(16), 4))),


            )




        );

        User::insert($adminRecords);


        /*$faker = Faker::create();

        $users = [];

        for ($i = 0; $i < 1000; $i++) {
            $users[] = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'name' => $faker->userName,
                'user_type' => 3, // Assuming 2 is a fixed user type
                'mobile' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123456'), // Securely hash password
                'image' => 'default.jpg', // Default image
                'status' => 1, // Active status
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert all users in bulk for performance optimization
        DB::table('users')->insert($users);*/

    }
}
