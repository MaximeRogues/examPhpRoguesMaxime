<?php
// on récupère les fonctions
require_once('../functions.php');
// on récupère la connexion à la BDD
require_once('../connexionBDD.php');

verifConnexion();

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $formulaireValide = validateExperienceForm();

    // on stocke les erreurs renvoyées par le formulaire validé
    $errors = $formulaireValide['errors'];

 
    // si il n'y a pas d'erreurs dans le tableau, le formulaire est validé
    if(count($errors) == 0) {
       //  On lance la fonction connectUser
      addExperience($pdo);
       // si aucune erreur, on redirige vers index.php
       if(count($errors) === 0) {
        header('Location: ../admin.php');
       }
    }
}
?>

<!-- bouton qui renvoie vers admin.php -->
<a href="../admin.php"> <button class="btn btn-primary">Retourner à la page admin</button></a>


<div class="text-center">

    <h3>Ajouter une expérience</h3>
    <br>
    <!-- formulaire d'ajout d'expérience -->
    <form action="addExperience.php" method="post">
        <label for="titreExp">Titre de l'expérience :</label>
        <input type="text" required name="titreExp"><br>
        <br>

        <label for="description">Description :</label>
        <input type="text" required name="description"><br>
        <br>

        <label for="dateDebut">Date de début :</label>
        <input type="date" required name="dateDebut"><br>
        <br>

        <label for="dateFin">Date de fin :</label>
        <input type="date" name="dateFin"><br>
        <br>

        <input type="submit" class="btn btn-success" value="Ajouter">
    </form>

</div>


<?php


afficherErreurs($errors);
?>