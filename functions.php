<?php

// vérification des champs du login
function validateLogin($pdo) {
    // on déclare le tableau d'erreurs vide
    $errors = [];

    if(empty($_POST['mail'])) {
        $errors[] = 'Veuillez entrer un mail';
    }

    if(empty($_POST['password'])) {
        $errors[] = 'Veuillez entrer un mot de passe';
    }
   
    return ['errors'=>$errors];
}

// vérification du mail et password
function connectUser($pdo) {
    // on déclare le tableau d'erreurs vide
    $errors = [];

    // je prépare ma requête pour trouver le mail et son mdp en BDD
    $requete = $pdo->prepare('SELECT * FROM user WHERE mail= :mail AND mot_de_passe = :password');
    // je lance la requête
    $requete->execute([
        'mail' => $_POST['mail'],
        'password' => md5($_POST['password'])
    ]);

    // je déclare resultat avec comme valeur le retour de ma requête 
    $resultat = $requete->fetch();

    // si la requête n'a rien renvoyé on affiche l'erreur
    if ( $resultat == false ) {
        $errors[] = 'Login ou mot de passe incorrect !';
    } else {  
    // si pas d'erreur, on redirige vers index.php
        $_SESSION['user'] = $resultat;
        header('Location: index.php');
    }

    return $errors;
}

// afficher des étoiles en fonction de la note
function afficherNote($note) {
    // le nb d'etoiles pleines
    for($i = 0; $i < $note; $i++) {
        echo('<img class="etoile " style="width: 2.5rem" src="images/fullStar.png">');
    }

    // le nb d'etoiles vides
    for($i = $note; $i < 5; $i++) {
        echo('<img class="etoile" style="width: 2.5rem" src="images/emptyStar.png">');
    }
}

function afficherErreurs($errors) {
    if(count($errors) != 0) {
        echo('<ul>');
        // on boucle sur le tableau d'erreurs
        foreach($errors as $error) {
            echo('<li>' . $error . '</li>');
        }
        echo('</ul>');
    }
}

function verifConnexion() {
    session_start();

    // si le user n'est pas défini, renvoie sur la page de login
    if(!$_SESSION['user']) {
        header('Location: ../login.php');
    }
}


// ------------------- FONCTIONS POUR LES COMPETENCES---------------------------------


// validation du formulaire d'ajout de compétence
function validateCompetenceForm() {
    $errors = [];

    if(empty($_POST['titreComp'])) {
        $errors[] = 'Veuillez entrer un titre pour cette compétence';
    }

    if(empty($_POST['note'])) {
        $errors[] = 'Veuillez entrer une note pour cette compétence';
    }

    if($_POST['note'] > 5) {
        $errors[] = 'Veuillez entrer une note inférieure ou égale à 5';
    }

    return ['errors'=>$errors];
}

// ajout de la compétence en BDD
function addCompetence($pdo) {
    // on prepare la requête SQL à envoyer
    $requete = $pdo -> prepare('INSERT INTO competence (titre, note) VALUES (:titre, :note)');

    // on éxecute la requête préparée
    $requete -> execute([
        'titre' => $_POST['titreComp'],
        'note' => $_POST['note'],
    ]);
}

// Supprimer une compétence en BDD
function deleteCompetence($pdo, $id) {
    // on prepare la requête DELETE FROM
    $res = $pdo->prepare('DELETE FROM competence WHERE id = :id');
    // on lance la requête
    $res->execute(['id'=> $id]);
}

// Modifier une compétence en BDD
function updateCompetence($pdo, $id) {
        $req = $pdo->prepare('UPDATE competence SET titre = :titre, note = :note WHERE id = :id');
        $req->execute([
            'titre' => $_POST['titreComp'],
            'note' => $_POST['note'],
            'id'=> $id
        ]);
}



// ------------------- FONCTIONS POUR LES EXPERIENCES ---------------------------------


// validation du formulaire d'ajout d'experience
function validateExperienceForm() {
    $errors = [];

    if(empty($_POST['titreExp'])) {
        $errors[] = 'Veuillez entrer un titre pour cette experience';
    }

    if(empty($_POST['description'])) {
        $errors[] = 'Veuillez entrer une description pour cette experience';
    }

    if(empty($_POST['dateDebut'])) {
        $errors[] = 'Veuillez entrer une date de début pour cette experience';
    }

    return ['errors'=>$errors];
}

// ajout de l'experience en BDD
function addExperience($pdo) {

    // si une date de fin est entrée
    if($_POST['dateFin']) {
        // on prepare la requête SQL à envoyer
        $requete = $pdo -> prepare('INSERT INTO experience (titre, description, date_debut, date_fin) VALUES (:titre, :description, :date_debut, :date_fin)');

        // on éxecute la requête préparée
        $requete -> execute([
            'titre' => $_POST['titreExp'],
            'description' => $_POST['description'],
            'date_debut' => $_POST['dateDebut'],
            'date_fin' => $_POST['dateFin']
        ]);
    } // si auncune date de fin
    else {
        // on prepare la requête SQL à envoyer
        $requete = $pdo -> prepare('INSERT INTO experience (titre, description, date_debut) VALUES (:titre, :description, :date_debut)');

        // on éxecute la requête préparée
        $requete -> execute([
            'titre' => $_POST['titreExp'],
            'description' => $_POST['description'],
            'date_debut' => $_POST['dateDebut']
        ]);
    }
    
}

// Supprimer une experience en BDD
function deleteExperience($pdo, $id) {
    // on prepare la requête DELETE FROM
    $res = $pdo->prepare('DELETE FROM experience WHERE id = :id');
    // on lance la requête
    $res->execute(['id'=> $id]);
}

// Modifier une experience en BDD
function updateExperience($pdo, $id) {
    // si le champ dateFin est rempli
    if($_POST['dateFin']) {
        // on prépare la requête
        $req = $pdo->prepare('UPDATE experience SET titre = :titre, description = :description, date_debut = :date_debut, date_fin = :date_fin WHERE id = :id');

        // on éxecute la requête préparée
        $req->execute([
        'titre' => $_POST['titreExp'],
        'description' => $_POST['description'],
        'date_debut' => $_POST['dateDebut'],
        'date_fin' => $_POST['dateFin'],
        'id'=> $id
    ]);
    } else {
        // si le champ dateFin est vide
        // on prépare la requête sans le champ date_fin
        $req = $pdo->prepare('UPDATE experience SET titre = :titre, description = :description, date_debut = :date_debut WHERE id = :id');

        // on éxecute la requête préparée
        $req->execute([
        'titre' => $_POST['titreExp'],
        'description' => $_POST['description'],
        'date_debut' => $_POST['dateDebut'],
        'id'=> $id
    ]);
    }
    
}
