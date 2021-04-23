<?php
include_once 'fragments/header.php';

include_once 'classes/Repository.php';// okeed ghadi ya ali xD
include_once 'classes/PersonneRepository.php'; 

/*
 * 1- Récupérer les identifiants
 * Tester si le login et le mot de passe correspondent
 * Si oui
 *  Redirige vers la page d'accueil
 * Si non
 *  Redirgie vers la page login avec un message d'erreur
 * */

//1 
$email = $_POST['email'];
$password = $_POST['pwd'];
$Repo = new Repository('admins');
$admin=$Repo->findByEmail($email);
if(!isset($email))
{
    header('location:login.php');
}



if (isset($email) && isset($password)) {
    if ($password == $admin->password && $admin->isadmin) {
        $_SESSION['user']=$admin->mail;

        $repo = new PersonneRepository();
        $repo->logMessageCreation("Logged in");
        header('location:home.php');
        
    } else {
        $_SESSION['errorMessage']="Veuillez vérifier vos credentials";
        header('location:login.php');
    }
} else {
    $_SESSION['errorMessage']="Veuillez vérifier vos credenitals";
    header('location:login.php');
}