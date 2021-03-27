<?php

function translations()
{
    $file = resource_path('lang/'. app()->getLocale() .'.json');

    if (!file_exists($file)) {
        return [];
    }

    return json_decode(file_get_contents($file), true);
}
