<?php
    include_once 'classes/PersonneRepository.php'   ;
    $repo = new PersonneRepository();
    $repo->addToDatabse($_POST);




    header('location:home.php');
?> 