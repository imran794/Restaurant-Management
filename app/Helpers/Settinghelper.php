<?php

if (!function_exists('setting')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function setting($name, $defaule = null)
    {
       return \App\Models\Setting::getByName($name, $defaule);
    }
}
