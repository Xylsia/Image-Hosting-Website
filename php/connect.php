<?php
    $host = 'localhost';
    $user = 'jovana';
    $password = 'test';
    $database = 'site';

    $object = new mysqli($host, $user, $password, $database);

    if($object->connect_error){
        die("Connection Error" . $object->connect_error);
    }

?>