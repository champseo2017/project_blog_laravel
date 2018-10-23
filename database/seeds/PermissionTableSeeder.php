<?php

use Illuminate\Database\Seeder;
use App\Model\admin\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permission = new Permission();
        $permission->name = 'Post-Create';
        $permission->for = 'post';
        $permission->save();
        
        $permission = new Permission();
        $permission->name = 'Post-update';
        $permission->for = 'post';
        $permission->save();
        
         $permission = new Permission();
        $permission->name = 'Post-Delete';
        $permission->for = 'post';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'Post-Publish';
        $permission->for = 'post';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'User-Create';
        $permission->for = 'user';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'User-Update';
        $permission->for = 'user';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'User-Delete';
        $permission->for = 'user';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'Tag-CRUD';
        $permission->for = 'other';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'Category-CRUD';
        $permission->for = 'other';
        $permission->save();
    }
}
