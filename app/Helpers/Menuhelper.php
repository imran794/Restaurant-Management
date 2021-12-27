<?php

if (!function_exists('menu')) {

    /**
     * get menu with item and child s by name
     *
     * @param
     * @return
     */
    function menu($name)
    {
        $menu = \App\Models\Menu::where('name',$name)->first();
        return $menu->MenuItems()->with('childe')->get();
    }
}
