<?php

use Illuminate\Database\Seeder;
use App\Model\admin\role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new role();
        $role->name = 'Editor';
        $role->save();

        $role = new role();
        $role->name = 'Publisher';
        $role->save();

        $role = new role();
        $role->name = 'Writer';
        $role->save();
    }
}
