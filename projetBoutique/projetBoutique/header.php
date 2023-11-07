<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="header.css" />
        <title>Lamazon</title>
    </head>
    <body>
    <div class="menu">
                <a href="index.php"><img class="logo" src="images/logo.jpg" alt="Logo"/></a>
                <a href="compte.php" class="compte">Compte</a>
                <a href="testPanier.php" class="compte">Panier</a>
                <form id="recherche" method="get" action="/search" autocomplete="off">
                    <input name="recherche"  type="text" placeholder="Recherche..." />
                    <input id="bouton-submit" type="submit" value="Go !" />
                </form>
    </div>