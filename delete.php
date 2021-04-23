<?php 
    include_once 'classes/PersonneRepository.php';
    $Repo=new PersonneRepository();
    $Repo->findByIdAndDelete($_GET['id']);
    header('location:home.php');
?>