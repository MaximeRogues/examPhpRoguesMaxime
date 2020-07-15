<?php

// on récupère les fonctions
require_once('functions.php');
// on récupère la connexion à la BDD
require_once('connexionBDD.php');

session_start();

// on détruit la session
session_destroy();

// on redirige vers index.php
header('Location: index.php');