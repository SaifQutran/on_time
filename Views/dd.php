<?php
use Modl\Tasks;

$spl_autoload_register(function($classname){
    var_dump($classname);

});
$user = new Tasks;