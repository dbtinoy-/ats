<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->save();

        $commentRole = new Role;
        $commentRole->name = 'comment';
        $commentRole->save();
        
        $recruiterRole = new Role;
        $recruiterRole->name = 'recruiter';
        $recruiterRole->save();

        $user = User::where('username','=','admin')->first();
        $user->attachRole( $adminRole );

        $user = User::where('username','=','applicant')->first();
        $user->attachRole( $commentRole );
        
        $user = User::where('username','=','recruiter')->first();
        $user->attachRole( $recruiterRole );
    }

}
