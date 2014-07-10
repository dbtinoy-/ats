<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();

        $permissions = array(
            array( // 1
                'name'         => 'manage_jobs',
                'display_name' => 'manage jobs'
            ),
            array( // 2
                'name'         => 'manage_cvs',
                'display_name' => 'manage cv'
            ),
            array( // 3
                'name'         => 'manage_job_posts',
                'display_name' => 'manage job posts'
            ),
            array( // 4
                'name'         => 'manage_comments',
                'display_name' => 'manage comments'
            ),
            array( // 5
                'name'         => 'manage_users',
                'display_name' => 'manage users'
            ),
            array( // 6
                'name'         => 'manage_roles',
                'display_name' => 'manage roles'
            ),
            array( // 7
                'name'         => 'post_comment',
                'display_name' => 'post comment'
            ),
        );

        DB::table('permissions')->insert( $permissions );

        DB::table('permission_role')->delete();

        $role_id_admin = Role::where('name', '=', 'admin')->first()->id;
        $role_id_comment = Role::where('name', '=', 'comment')->first()->id;
        $permission_base = (int)DB::table('permissions')->first()->id - 1;

        $permissions = array(
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 1
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 2
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 3
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 4
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 5
            ),
            array(
                'role_id'       => $role_id_admin,
                'permission_id' => $permission_base + 6
            ),
            array(
                'role_id'       => $role_id_comment,
                'permission_id' => $permission_base + 6
            ),
        );

        DB::table('permission_role')->insert( $permissions );
    }

}