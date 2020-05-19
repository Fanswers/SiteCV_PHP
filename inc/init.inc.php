<?php
//--------- BDD ---------//
$mysqli = new mysqli("localhost", "root", "", "sitecv_php");
if ($mysqli->connect_error) die('Un problème est survenu lors de la tentative de connexion à la BDD : ' . $mysqli->connect_error);
 
//--------- SESSION ---------//
session_start();
 
//--------- VARIABLES ---------//
$contenu = '';
 
//--------- INCLUSIONS ---------//
require_once("fonction.inc.php");