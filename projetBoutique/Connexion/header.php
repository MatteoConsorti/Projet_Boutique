<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="header.css" />
        <title>Lamazon</title>
    </head>
    <body>
    <div class="menu">
                <a href="../index.php"><img class="logo" src="images/logo.jpg" alt="Logo"/></a>
                <a href="inscription.php" class="compte">Compte</a>
                <a href="testPanier.php" class="compte">Panier</a>
                <form action="recherche.php" method="GET">
                    <label for="query">Recherche :</label>
                    <input type="text" id="query" name="query" required>
                    <button type="submit">Rechercher</button>
                </form>
    </div>