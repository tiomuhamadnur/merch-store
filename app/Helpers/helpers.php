<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('activeClass')) {

    function activeClass($patterns, $active = 'active bg-gradient-dark text-white', $inactive = 'text-dark')
    {
        foreach ((array)$patterns as $pattern) {
            if (Request::routeIs($pattern)) {
                return $active;
            }
        }

        return $inactive;
    }
}
