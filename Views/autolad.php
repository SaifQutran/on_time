<?php
spl_autoload_register('Myautolader');
function Myautolader($classname){
    $path = "modl/";
    $extension =".php";
    $fullpath = $path.$classname.$extension;
    include_once $fullpath;

}