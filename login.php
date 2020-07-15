<?php
// on récupère les fonctions
require_once('functions.php');
// on récupère la connexion à la BDD
require_once('connexionBDD.php');


session_start();

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

     // on stocke le retour du formulaire validé
     $loginValide = validateLogin($pdo);
     // on stocke les erreurs renvoyées par le formulaire validé
     $errors = $loginValide['errors'];
 
     // si il n'y a pas d'erreurs dans le tableau, le formulaire est validé
     if(count($errors) == 0) {
        //  On lance la fonction connectUser
       $errors =  connectUser($pdo);
        // si aucune erreur, on redirige vers index.php
        if(count($errors) === 0) {
         header('Location: admin.php');
        }
     }

}
?>

<h2 class="text-center">Veuillez entrer vos identifiants</h2>
<br>
<form class="text-center" method="post" action="login.php" enctype="multipart/form-data">
    <label>Adresse mail : </label>
    <input name="mail" type="text" required placeholder="Adresse mail"> <br>
    <br>
    <label>Mot de passe : </label>
    <input name="password" type="password" required placeholder="Mot de passe"> <br>
    <br>

    <input type="submit" value="Connexion">
</form>
<br>



<?php


afficherErreurs($errors);
?>