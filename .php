<?php

    $user='root';
    $pass='';
    $db='projet';
    $db=new mysqli('localhost',$user,$pass,$db) or die("unable to connect");

    if($db->connect_error){
    die('Erreur : ' .$db->connect_error);
    }

?>