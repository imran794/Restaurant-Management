<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuItem;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $backendsidebar = Menu::updateOrCreate([
            'name'              => 'backend-sidebar',
            'description'       => 'This is Backend Sidebar Menu',
            'deleteable'        => false
       ]);

       $backendsidebar->MenuItems()->updateOrCreate([
           'type'            => 'divider',
           'order'           => 1,
           'divider_title'   => 'Menus'
       ]);

         $backendsidebar->MenuItems()->updateOrCreate([
           'type'            => 'item',
           'order'           => 2,
           'title'           => 'Dashboard',
           'url'             => '/app/dashboard',
           'icon_class'      => 'metismenu-icon pe-7s-rocket',
       ]);

         $backendsidebar->MenuItems()->updateOrCreate([
           'type'            => 'item',
           'order'           => 3,
           'title'           => 'Pages',
           'url'             => '/app/pages',
           'icon_class'      => 'metismenu-icon pe-7s-news-paper',
       ]);



       $backendsidebar->MenuItems()->updateOrCreate([
           'type'            => 'divider',
           'order'           => 4,
           'divider_title'   => 'Access Control'
       ]);

         $backendsidebar->MenuItems()->updateOrCreate([
           'type'            => 'item',
           'order'           => 5,
           'title'           => 'Roles',
           'url'             => '/app/roles',
           'icon_class'      => 'metismenu-icon pe-7s-check',
       ]);

         $backendsidebar->MenuItems()->updateOrCreate([
           'type'            => 'item',
           'order'           => 6,
           'title'           => 'Users',
           'url'             => '/app/users',
           'icon_class'      => 'metismenu-icon pe-7s-users',
       ]);


        $backendsidebar->MenuItems()->updateOrCreate([
           'type'            => 'divider',
           'order'           => 7,
           'divider_title'   => 'System'
       ]);

         $backendsidebar->MenuItems()->updateOrCreate([
           'type'            => 'item',
           'order'           => 8,
           'title'           => 'Menus',
           'url'             => '/app/menus',
           'icon_class'      => 'metismenu-icon pe-7s-menu',
       ]);

         $backendsidebar->MenuItems()->updateOrCreate([
           'type'            => 'item',
           'order'           => 9,
           'title'           => 'Backups',
           'url'             => '/app/backups',
           'icon_class'      => 'metismenu-icon pe-7s-cloud',
       ]);

        $backendsidebar->MenuItems()->updateOrCreate([
           'type'            => 'item',
           'order'           => 10,
           'title'           => 'Setttings',
           'url'             => '/app/setting/general',
           'icon_class'      => 'metismenu-icon pe-7s-settings',
       ]);

           $backendsidebar->MenuItems()->updateOrCreate([
           'type'            => 'divider',
           'order'           => 11,
           'divider_title'   => 'Frontend'
       ]);


        $backendsidebar->MenuItems()->updateOrCreate([
           'type'            => 'item',
           'order'           => 12,
           'title'           => 'Slider',
           'url'             => '/app/sliders',
           'icon_class'      => 'metismenu-icon pe-7s-fa-sliders',
       ]);
    }
}
