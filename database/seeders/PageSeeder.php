<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::updateOrCreate([
            'title'               => 'About',
            'slug'                => 'about',
            'excerpt'             => 'this is about page',
            'body'                => '<h1>this is about page</h1>',
            'meta_description'    => 'about des',
            'meta_keywords'       => 'about, ect',
            'status'              => true,
        ]);
    }
}
