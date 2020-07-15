<?php
// on récupère les fonctions
require_once('../functions.php');
// on récupère la connexion à la BDD
require_once('../connexionBDD.php');

verifConnexion();

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $formulaireValide = validateCompetenceForm();

    // on stocke les erreurs renvoyées par le formulaire validé
    $errors = $formulaireValide['errors'];

 
    // si il n'y a pas d'erreurs dans le tableau, le formulaire est validé
    if(count($errors) == 0) {
       //  On lance la fonction addCompetence
      addCompetence($pdo);
       // si aucune erreur, on redirige vers admin.php
       if(count($errors) === 0) {
        header('Location: ../admin.php');
       }
    }
}

?>

<!-- bouton qui renvoie vers admin.php -->
<a href="../admin.php"> <button class="btn btn-primary">Retourner à la page admin</button></a>


<div class="text-center">
    <h3>Ajouter une compétence</h3>
    <br>
    <!-- formulaire d'ajout de competence -->
    <form action="addCompetence.php" method="post">
        <label for="titreComp">Titre de la compétence :</label>
        <input type="text" name="titreComp"><br>
        <br>

        <label for="note">Note sur 5 :</label>
        <input type="number" name="note" max="5"><br>
        <br>

        <input type="submit" class="btn btn-success" value="Ajouter">
    </form>
</div>
<br>
<br>

<?php


afficherErreurs($errors);
?>