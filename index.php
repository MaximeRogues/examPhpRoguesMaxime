<?php

// on récupère les fonctions
require_once('functions.php');
// on récupère la connexion à la BDD
require_once('connexionBDD.php');

session_start();

session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Maxime Rogues</title>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&display=swap" rel="stylesheet">

    <link href="style.css" rel="stylesheet">

   
</head>

<body>


    <div id="rectangleBleu" class="bg-primary">
    </div>

    <a href="login.php">
        <p class="float-right mr-5"> Vous êtes l'admin ? (ou Aurélien Delorme)</p>
    </a>

    <br>
    <div id="header">
        <h1 class="font-weight-bold">Maxime Rogues</h1>
        <h2>Développeur web/ web mobile</h2>

    </div>

    <br>

    <div id="contactParcours">

        <div id="sideBar" class="bg-primary text-light p-3 md-0 ">
            <br>
            <h4 class="font-weight-bold">Contact</h4>
            <p>25 bis Boulevard François Delay</p>
            <p>42400 Saint-Chamond</p>
            <p>github.com/MaximeRogues</p>
            <br>
            <!-- compétences à afficher en php -->
            <h4 class="font-weight-bold">Compétences</h4>
            <ul>
                <?php
                // on appelle toutes les competences de la BDD et on les stocke dans $competences
                $competences = $pdo->query('SELECT * FROM competence');

                foreach($competences as $competence) {
                    echo('<li>
                            <h4>' . $competence['titre'] . '</h4>');
                            // on appelle la fonction afficher note pour les étoiles
                            afficherNote($competence['note']);
                            
                    echo('</li>');
                }
                ?>
            </ul>

            <br>
            <!--  -->
            <h4 class="font-weight-bold">Langues</h4>
            <p>Anglais :</p>
            <ul>
                <li>
                    <p>Ecrit :
                        <div class="progress">
                            <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>
                    </p>
                </li>
                <li>
                    <p>Oral :</p>
                    <div class="progress">
                        <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                            aria-valuemax="100" style="width: 80%"></div>
                    </div>
                </li>
            </ul>
            <br>
            
        </div>
        <br>

        <div id="parcours" class="p-3">
            <p>
                <img class="quoteLeft" src="images/quote-left-solid.svg" alt="">
                Déterminé et désireux d'apprendre le plus possible, je
                recherche un stage en développement dans le cadre de ma formation
                <img class="quoteRight" src="images/quote-right-solid.svg" alt="">
            </p>
            <br>
            <h3 class="text-info font-weight-bold">Formation</h3>
            <ul>
                <li>
                    <h4>Développeur web/ web mobile</h4>
                    <p>Human Booster à Saint Etienne | 04/2020 – 12/2020</p>
                    <p>Diplôme d'Etat équivalent Bac+2</p>
                </li>
                <br>
                <li>
                    <h4>Bac Pro Boulangerie-pâtisserie</h4>
                    <p>Lycée Professionnel Hôtelier Saint-Chamond | 2015</p>
                </li>
            </ul>
            <br>
            <!-- a afficher en php -->
            <h3 class="text-info font-weight-bold">Expériences professionnelles</h3>

            <ul>
                <?php
                // on appelle toutes les expériences de la BDD et on les stocke dans $experiences
                $experiences = $pdo->query('SELECT * FROM experience');

                    foreach($experiences as $experience) {
                        echo('<li>
                                <u><h4>' . $experience['titre'] . '</h4></u>
                                <p>' . $experience['date_debut'] . '</p>');

                                if(isset($experience['date_fin'])) {
                                    echo('<p>' . $experience['date_fin'] . '</p>');
                                }

                                echo('<p>' . $experience['description'] . '</p>
                                
                                
                            </li>');
                    }
                ?>
                
            </ul>
            <br>
            <!--  -->
            <h3 class="text-info font-weight-bold">Projets personnels</h3>
            <ul>
                <li>
                    <p> Applications mobile Android :</p>
                    <ul>
                        <li>
                            <p> Application de lancer de dés avec nombre de faces dynamique (Java, front-only) </p>
                        </li>
                        <li>
                            <p> Application de quiz avec compteur de score (Java, front-only) </p>
                        </li>
                    </ul>
                </li>
                <br>
                <li>
                    <p> Soundboard en ligne (Angular, front et back)</p>
                </li>
                <br>
                <li>
                    <p>Site sur la mythologie grecque (Front en Angular, back en Php)</p>
                </li>
            </ul>
        </div>

    </div>


</body>

</html>