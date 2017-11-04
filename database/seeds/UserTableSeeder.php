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
        DB::table('users')->insert([
        	'email' => 'kokey@gmail.com',
          'name' => 'PiCo Lo',
        	'password' => Hash::make('picolo'),
          'typeOfUser' => '1',
          'profile_path' => 'assets/images/user.png'
        	]);
        // $j=1;
        // for($i = 6; $i <= 45; $i++){
        //   DB::table('group_members')->insert([
        //     	'group_id' => 2,
        //       'user_id' => $i,
        //       'typeOfUser' => '1'
        //     	]);
        //       DB::table('notifications')->insert([
        //         	'id' => 1,
        //           'fromUser' => $i,
        //           'has_read' => 0,
        //           'notif_message' => 'FirstName'.$j.' B. Lastname joined to your group Oracle.'
        //         	]);
        //           $j++;
        // }
        //     DB::table('users')->insert([
        //     	'email' => 'admin@gmail.com',
        //       'name' => 'Admin',
        //     	'password' => Hash::make('adminisme'),
        //       'typeOfUser' => '3',
        //       'profile_path' => 'assets/images/admin.png'
        //     	]);
    }
}
