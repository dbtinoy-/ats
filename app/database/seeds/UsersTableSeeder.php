<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();


        $users = array(
            array(
                'username'      => 'admin',
                'email'      => 'admin@example.org',
                'password'   => Hash::make('admin'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'firstname'  => 'admin',
                'middlename'  => 'admin',
                'lastname'  => 'admin',
                'gender'  => 'male',
                'phone'  => '00000',
                'civil_status'  => 'single',
                'citizenship'  => 'filipino',
            ),
            array(
                'username'      => 'recruiter',
                'email'      => 'recruiter@example.org',
                'password'   => Hash::make('recruiter'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'firstname'  => 'recruiter',
                'middlename'  => 'recruiter',
                'lastname'  => 'recruiter',
                'gender'  => 'male',
                'phone'  => '00000',
                'civil_status'  => 'single',
                'citizenship'  => 'filipino',                
            ),
            array(
                'username'      => 'applicant',
                'email'      => 'applicant@example.org',
                'password'   => Hash::make('applicant'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
                'firstname'  => 'applicant',
                'middlename'  => 'applicant',
                'lastname'  => 'applicant',
                'gender'  => 'male',
                'phone'  => '00000',
                'civil_status'  => 'single',
                'citizenship'  => 'filipino',                 
            )
        );

        DB::table('users')->insert( $users );
        

        $adminId = User::where('username','=','admin')->first()->id;
        DB::table('users_admins')->delete();
        $admin = array(array('userable_id' => $adminId, 'userable_type'=>'admin'));
        DB::table('users_admins')->insert( $admin );
        
        $applicantId = User::where('username','=','applicant')->first()->id;
        DB::table('users_applicants')->delete();
        $applicant = array(array('userable_id' => $applicantId, 'userable_type'=>'applicant'));
        DB::table('users_applicants')->insert( $applicant );
        
        $recruiterId = User::where('username','=','recruiter')->first()->id;
        DB::table('users_recruiters')->delete();
        $recruiter = array(array('userable_id' => $recruiterId, 'userable_type'=>'recruiter'));
        DB::table('users_recruiters')->insert( $recruiter );
        
    }

}
