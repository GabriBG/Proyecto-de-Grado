<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder{

    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Docente']);
        $role3 = Role::create(['name' => 'Director']);

        Permission::create(['name' => 'admin.persona'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.asignatura'])->syncRoles([$role1, $role3]);;

    }
}