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
        DB::table('notifications')->insert([
        	'id' => 4,
          'fromUser' => 1,
        	'has_read' => '0',
          'notif_message' => 'This message is a trial'
        	]);
        DB::table('notifications')->insert([
          'id' => 4,
          'fromUser' => 2,
          'has_read' => '0',
          'notif_message' => 'Also this message'
          ]);
        DB::table('notifications')->insert([
          'id' => 4,
          'fromUser' => 3,
          'has_read' => '0',
          'notif_message' => 'Trial Message'
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
