<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
  public function run()
  {
    $role_employee = new Role();
    $role_employee->name = 'admin';
    $role_manager->description = 'A Admin User';
    $role_employee->save();

    $role_manager = new Role();
    $role_manager->name = 'manager';
    $role_manager->description = 'A Manager User';
    $role_manager->save();

    $role_manager = new Role();
    $role_manager->name = 'Customer';
    $role_manager->description = 'A Customer User';
    $role_manager->save();
  }
}
