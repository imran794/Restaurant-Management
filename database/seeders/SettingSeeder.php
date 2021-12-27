<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // general setting 

        Setting::updateOrCreate(['name' => 'site_title'],['value'=> 'MyFramework']);
        Setting::updateOrCreate(['name' => 'site_description'],['value'=> 'A Laravel Framework for Web Artisan']);
        Setting::updateOrCreate(['name' => 'site_address'],['value'=> 'Chunkutia Keraniganj Dhaka, Bangladesh']);
    }
}
