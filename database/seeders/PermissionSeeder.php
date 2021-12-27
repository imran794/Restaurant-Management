<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Module;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Admin Dashboard

        $moduleAppDashboard = Module::updateOrCreate(['Name' => 'Admin Dashboard']);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppDashboard->id,
            'name'           => 'Access Dashboard',
            'slug'           => 'app.dashboard',
         ]);


       // /Role Management

        $moduleAppRole = Module::updateOrCreate(['name'  => 'Role Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name'      => 'Access Role',
            'slug'      => 'app.role.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name'      => 'Role Create',
            'slug'      => 'app.role.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name'      => 'Role Edit',
            'slug'      => 'app.role.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name'      => 'Role Delete',
            'slug'      => 'app.role.delete'
        ]);


        // User Management
        $moduleAppUser = Module::updateOrCreate(['name'  => 'User Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name'      => 'Access User',
            'slug'      => 'app.user.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name'      => 'User Create',
            'slug'      => 'app.user.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name'      => 'User Edit',
            'slug'      => 'app.user.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name'      => 'User Delete',
            'slug'      => 'app.user.delete'
        ]);


         //Backups
        $moduleAppbackups = Module::updateOrCreate(['name'  => 'Backups']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppbackups->id,
            'name'      => 'Access Backup',
            'slug'      => 'app.backups.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppbackups->id,
            'name'      => 'Create Backup',
            'slug'      => 'app.backups.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppbackups->id,
            'name'      => 'Download Backup',
            'slug'      => 'app.backups.download'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppbackups->id,
            'name'      => 'Delete Backup',
            'slug'      => 'app.backups.delete'
        ]);


         //Pages
        $moduleApppages = Module::updateOrCreate(['name'  => 'Page Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleApppages->id,
            'name'      => 'Access Backup',
            'slug'      => 'app.pages.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleApppages->id,
            'name'      => 'Create Backup',
            'slug'      => 'app.pages.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleApppages->id,
            'name'      => 'Edit Backup',
            'slug'      => 'app.pages.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleApppages->id,
            'name'      => 'Delete Backup',
            'slug'      => 'app.pages.delete'
        ]);


         //Menu
        $moduleAppMenu = Module::updateOrCreate(['name'  => 'Menu Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name'      => 'Access Menu Builder',
            'slug'      => 'app.menus.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name'      => 'Create Menu',
            'slug'      => 'app.menus.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name'      => 'edit Menu',
            'slug'      => 'app.menus.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name'      => 'Delete Menu',
            'slug'      => 'app.menus.delete'
        ]);



         //fronetnd slider
        $moduleAppslider = Module::updateOrCreate(['name'  => 'Slider Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppslider->id,
            'name'      => 'Access Slider',
            'slug'      => 'app.slider.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppslider->id,
            'name'      => 'Create Slider',
            'slug'      => 'app.slider.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppslider->id,
            'name'      => 'edit Slider',
            'slug'      => 'app.slider.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppslider->id,
            'name'      => 'Delete Slider',
            'slug'      => 'app.slider.delete'
        ]);
    }
}
