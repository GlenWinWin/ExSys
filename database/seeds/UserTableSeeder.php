<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        // 	'email' => 'enricochavez@gmail.com',
        //   'name' => 'Enrico Chavez',
        // 	'password' => Hash::make('chavez'),
        //   'typeOfUser' => '2',
        //   'profile_path' => 'assets/images/sir_chavez.jpg'
        // 	]);
        DB::table('users')->insert([
        	'email' => 'rednax@gmail.com',
          'name' => 'Xander Faustino',
        	'password' => Hash::make('rednax'),
          'typeOfUser' => '2',
          'profile_path' => 'assets/images/xander.jpg'
        	]);
        // DB::table('users')->insert([
        //   	'email' => 'glenwinbernabe@gmail.com',
        //     'name' => 'Glenwin G. Bernabe',
        //   	'password' => Hash::make('1234'),
        //     'typeOfUser' => '1',
        //     'profile_path' => 'assets/images/user.png'
        //   	]);
        //     DB::table('users')->insert([
        //     	'email' => 'admin@gmail.com',
        //       'name' => 'Admin',
        //     	'password' => Hash::make('adminisme'),
        //       'typeOfUser' => '3',
        //       'profile_path' => 'assets/images/admin.png'
        //     	]);
    }
}
