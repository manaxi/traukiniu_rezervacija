<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
  public function run()
  {
    $role_employee = Role::where('name', 'admin')->first();
    $role_manager  = Role::where('name', 'manager')->first();

    $employee = new User();
    $employee->name = 'Admin Name';
    $employee->email = 'employee@example.com';
    $employee->password = bcrypt('secret');
    $employee->save();
    $employee->roles()->attach($role_employee);

    $manager = new User();
    $manager->name = 'Manager Name';
    $manager->email = 'manager@example.com';
    $manager->password = bcrypt('secret');
    $manager->save();
    $manager->roles()->attach($role_manager);

    $manager = new User();
    $manager->name = 'Customer Name';
    $manager->email = 'customer@example.com';
    $manager->password = bcrypt('secret');
    $manager->save();
    $manager->roles()->attach($role_manager);
  }
}
