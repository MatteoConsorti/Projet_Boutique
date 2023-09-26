<?php
    $host = "localhost"; // Adresse de l'hôte MySQL
    $user = ""; // Nom d'utilisateur MySQL
    $password = "root"; // Mot de passe MySQL
    $database = "boutique_telephone"; // Nom de la base de données


    // Établir la connexion à la base de données
    $mysqli = new mysqli($host, $user, $password, $database);

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);    
    }

    // Définir le jeu de caractères à utiliser (UTF-8 par exemple)
    $mysqli->set_charset("utf8");
?>
