<?php
if (!function_exists('public_path')) {
/**
    * Get the path to the public folder.
    *
    * @param  string $path
    * @return string
    */
    function public_path($path = '')
    {
        return env('PUBLIC_PATH', base_path('public')) . ($path ? '/' . $path : $path);
    }
}


if (!function_exists('storage_path')) {
    /**
     * Get the path to the storage_path folder.
     *
     * @param  string $path
     * @return string
     */
    function storage_path($path = '')
    {
        return env('STORAGE_PATH', base_path('storage')) . ($path ? '/images/' . $path : $path);
    }
}