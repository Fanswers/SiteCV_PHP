<?php
require_once("../inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(!internauteEstConnecteEtEstAdmin()) header("location:../index.php");
// debug($_SESSION);
var_dump($_SESSION);
$contenu .= '<p class="centre">Bonjour <strong>' . $_SESSION['membre']['pseudo'] . '</strong></p>';
$contenu .= '<div class="cadre"><h2> Voici vos informations </h2>';
$contenu .= '<p> votre email est: ' . $_SESSION['membre']['email'] . '<br>';
$contenu .= 'votre ville est: ' . $_SESSION['membre']['ville'] . '<br>';
$contenu .= 'votre cp est: ' . $_SESSION['membre']['code_postal'] . '<br>';
$contenu .= 'votre adresse est: ' . $_SESSION['membre']['adresse'] . '</p></div><br><br>';
//--------------------------------- AFFICHAGE HTML ---------------------------------//
echo $contenu;
