<?php

function init_load($class)
{
    $parts = explode('\\', $class);

    if (strpos($parts[0],'PHPUnit') !== false || strpos($class, 'Composer') !== false)
    {
        //Dont autoload
        return false;
    }

    if(isset($parts[3]))
    {
        require __DIR__ .'/../'.$parts[0] .'/'.$parts[1].'/'.$parts[2].'/'.$parts[3].'.php';

    }
    else if(isset($parts[2]))
    {
        require __DIR__ .'/../'.$parts[0] .'/'.$parts[1].'/'.$parts[2].'.php';
    }
    else
    {
        require __DIR__ .'/../'.$parts[0] .'/'.$parts[1].'.php';
    }
}

spl_autoload_register("init_load");