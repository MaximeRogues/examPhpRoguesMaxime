<?php
// on récupère les fonctions
require_once('../functions.php');
// on récupère la connexion à la BDD
require_once('../connexionBDD.php');

verifConnexion();

?>

<div class="text-center">
    <br>
    <h1>Les compétences</h1><br>
    <br>
    <!-- bouton  qui renvoie vers index.php -->
    <a href="../index.php"> <button class="btn btn-primary">Retourner au CV</button></a>
    <br>
    <br>
    <!-- bouton qui renvoie vers addCompetence.php -->
    <a href="addCompetence.php"> <button class="btn btn-primary">Ajouter une compétence</button></a>
    <br>
    <br>
</div>

<table class="text-center table">
    <thead class="thead-dark">
        <th>Titre</th>
        <th>Note</th>
        <th></th>
    </thead>
    <tbody>
        <?php
        // on appelle toutes les competences de la BDD et on les stocke dans $reponse
        $reponse = $pdo->query('SELECT * FROM competence');

        // tant qu'on peut selectionner dans $reponse on affiche une ligne de html
        while ($data = $reponse->fetch()) {
        ?>
        <tr>
            <td><?php echo($data['titre']); ?></td>
            <td><?php echo($data['note']); ?></td>
            <td>
                <a title="Editer" href="editCompetence.php?id=<?php echo($data['id']); ?>">
                    <button class="btn btn-success">Editer</button>
                </a>
                <a title="Supprimer" href="deleteCompetence.php?id=<?php echo($data['id']); ?>">
                    <button class="btn btn-danger">Supprimer</button>
                </a>
            </td>
        </tr>

        <?php
        }
    // on coupe la connection au serveur mais elle peut être relancée 
    $reponse->closeCursor();
        ?>
</table>
</tbody>