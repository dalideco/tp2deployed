<?php
    include_once 'classes/PersonneRepository.php';
    $repo = new PersonneRepository();
    $repo -> changeDatabase($_POST);

    
    header('location:home.php');
?>