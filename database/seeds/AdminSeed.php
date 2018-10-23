<?php

use Illuminate\Database\Seeder;
use App\Model\admin\admin;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new admin();
        $admin->name = 'admin001';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('123456');
        $admin->phone = '093-1848557';
        $admin->status = '1';
        $admin->save();
    }
}
