<?php

function load($c) {
    if (strpos($c, "Cyclos\\") >= 0) {
        include str_replace("\\", "/", $c) . ".php";
    }    
}

spl_autoload_register('load'); 

Cyclos\Configuration::setRootUrl("http://127.0.0.1:8080/cyclos/global/");
Cyclos\Configuration::setAuthentication("mazouthm", "admin");
?>

