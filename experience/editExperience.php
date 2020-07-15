<?php
// on récupère les fonctions
require_once('../functions.php');
// on récupère la connexion à la BDD
require_once('../connexionBDD.php');

verifConnexion();

// on définie resultat avec le contenu de ce que renvoie le serveur
$resultat = $pdo->prepare('SELECT * FROM experience WHERE id = :idRecherche');
// on récupère l'id qui est dans l'url
$resultat->execute(['idRecherche'=> $_GET['id']]);
// on stocke le résultat de la recherche dans une variable
$experience = $resultat->fetch();

$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $formulaireValide = validateExperienceForm();

    // on stocke les erreurs renvoyées par le formulaire validé
    $errors = $formulaireValide['errors'];

 
    // si il n'y a pas d'erreurs dans le tableau, le formulaire est validé
    if(count($errors) == 0) {
       //  On lance la fonction updateexperience
       updateExperience($pdo, $experience['id']);
       // si aucune erreur, on redirige vers listeexperience.php
       if(count($errors) === 0) {
        header('Location: listeExperience.php');
       }
    }
}
?>



<div class="text-center">

    <h3>Modifier l'expérience</h3>
    <br>
    <!-- formulaire d'edition d'expérience -->
    <form action="editExperience.php?id=<?php echo($experience['id']); ?>" method="post">
        <label for="titreExp">Titre de l'expérience :</label>
        <input type="text" required name="titreExp" value="<?php echo($experience['titre']) ?>"><br>
        <br>

        <label for="description">Description :</label>
        <input type="text" required name="description" value="<?php echo($experience['description']) ?>"><br>
        <br>

        <label for="dateDebut">Date de début :</label>
        <input type="date" required name="dateDebut" value="<?php echo($experience['date_debut']) ?>"><br>
        <br>

        <label for="dateFin">Date de fin :</label>
        <input type="date" name="dateFin" value="<?php if($experience['date_fin']) {
          echo($experience['date_fin']);  
        } ?>"><br>
        <br>

        <input type="submit" class="btn btn-success" value="Modifier">
    </form>

</div>
<br>

<?php


afficherErreurs($errors);
?>