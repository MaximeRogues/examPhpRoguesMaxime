<?php
// on récupère les fonctions
require_once('functions.php');
// on récupère la connexion à la BDD
require_once('connexionBDD.php');

session_start();

// si le user n'est pas défini, renvoie sur la page de login
if(!$_SESSION['user']) {
    header('Location: login.php');
}

echo('<h3 class="text-center">Salut ' . $_SESSION['user']['nom'] . ' ' . $_SESSION['user']['nom'] . '</h3>');

?>

<h2 class="text-center">Regarde tout c'qu'on peut faire !</h2>
<br>

<div class="text-center">


<!-- bouton deconnexion qui renvoie vers index.php -->
<a href="deconnexion.php"> <button class="btn btn-danger" >Déconnexion</button></a>

<!-- bouton  qui renvoie vers index.php -->
<a href="index.php"> <button class="btn btn-primary" >Retourner au CV</button></a>
<br>
<br>

<!-- bouton qui renvoie vers listeCompetence.php -->
<a href="competence/listeCompetence.php"> <button class="btn btn-primary" >Liste des compétences</button></a>

<!-- bouton  qui renvoie vers listeExperience.php -->
<a href="experience/listeExperience.php"> <button class="btn btn-primary" >Liste des expériences</button></a>
<br>
<br>

</div>


