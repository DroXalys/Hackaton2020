<?php   
/*Déconnexion du site*/
session_start();
unset($_SESSION["identifiant"]);
unset($_SESSION["mot_de_passe"]);
header('Location: login.php');
?>