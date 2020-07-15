<?php
// on récupère les fonctions
require_once('../functions.php');
// on récupère la connexion à la BDD
require_once('../connexionBDD.php');

verifConnexion();


// on déclare $id avec comme valeur l'id passée dans l'url
$id = $_GET['id'];

// on lance la fonction delete avec comme paramètre l'id récupéré
deleteCompetence($pdo, $id);
// on redirige vers listeCompetence
header('Location: listeCompetence.php');

?>