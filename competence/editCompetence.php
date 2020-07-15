<?php
// on récupère les fonctions
require_once('../functions.php');
// on récupère la connexion à la BDD
require_once('../connexionBDD.php');

verifConnexion();

$errors = [];

// on définie resultat avec le contenu de ce que renvoie le serveur
$resultat = $pdo->prepare('SELECT * FROM competence WHERE id = :idRecherche');
// on récupère l'id qui est dans l'url
$resultat->execute(['idRecherche'=> $_GET['id']]);
// on stocke le résultat de la recherche dans une variable
$competence = $resultat->fetch();



if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $formulaireValide = validateCompetenceForm();
    // on stocke les erreurs renvoyées par le formulaire validé
    $errors = $formulaireValide['errors'];

    // si il n'y a pas d'erreurs dans le tableau, le formulaire est validé
    if(count($errors) == 0) {
       //  On lance la fonction updateCompetence
       updateCompetence($pdo, $competence['id']);
       // si aucune erreur, on redirige vers listeCompetence.php
       if(count($errors) === 0) {
        header('Location: listeCompetence.php');
       }
    }
}
?>



<div class="text-center">
    <h3>Modifier la compétence</h3>
    <br>
    <!-- formulaire d'edition de competence -->
    <form method="post" action="editCompetence.php?id=<?php echo($competence['id']);?>">
        <label for="titreComp">Titre de la compétence :</label>
        <input type="text" name="titreComp" value="<?php echo($competence['titre']) ?>"><br>
        <br>

        <label for="note">Note sur 5 :</label>
        <input type="number" name="note" max="5" value="<?php echo($competence['note']) ?>"><br>
        <br>

        <input type="submit" class="btn btn-success" value="Modifier">
    </form>
</div>
<br>
<br>

<?php


afficherErreurs($errors);
?>