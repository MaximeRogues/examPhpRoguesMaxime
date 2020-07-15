<?php
// on récupère les fonctions
require_once('../functions.php');
// on récupère la connexion à la BDD
require_once('../connexionBDD.php');

verifConnexion();

?>

<div class="text-center">
    <br>
    <h1 >Les expériences</h1><br>
    <br>
    <!-- bouton  qui renvoie vers index.php -->
    <a href="../index.php"> <button class="btn btn-primary">Retourner au CV</button></a>
    <br>
    <br>
    <!-- bouton qui renvoie vers addExperience.php -->
    <a href="addExperience.php"> <button class="btn btn-primary">Ajouter une experience</button></a>
    <br>
    <br>
</div>

<table class="text-center table">
    <thead class="thead-dark">
        <th>Titre</th>
        <th>Description</th>
        <th>Date de début</th>
        <th>Date de fin</th>
        <th></th>
    </thead>
    <tbody>
        <?php
        // on appelle toutes les experiences de la BDD et on les stocke dans $reponse
        $reponse = $pdo->query('SELECT * FROM experience');

        // tant qu'on peut selectionner dans $reponse on affiche une ligne de html
        while ($data = $reponse->fetch()) {
        ?>
        <tr>
            <td><?php echo($data['titre']); ?></td>
            <td><?php echo($data['description']); ?></td>
            <td><?php echo($data['date_debut']); ?></td>
            <td><?php if($data['date_fin']) {
                    echo($data['date_fin'] . '</td>'); 
                } else {
                    echo('En cours </td>');
                }
                ?>

            <td>
                <a title="Editer" href="editExperience.php?id=<?php echo($data['id']); ?>">
                    <button class="btn btn-success">Editer</button>
                </a>
                <a title="Supprimer" href="deleteExperience.php?id=<?php echo($data['id']); ?>">
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