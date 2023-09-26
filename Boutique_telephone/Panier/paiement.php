<?php ?>

<link rel="stylesheet" href="paiement.css">
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,700,700i,800,800i,900,900i|Pacifico" rel="stylesheet">

</head>

<body>
    <form action="" id="purchase">
        <section class="customer">
            <h2>You</h2>
            <label for="name">Nom</label>
            <input type="text" name="name" placeholder="First & last name" id="name">
            <label for="email">E-mail</label>
            <input type="text" placeholder="you@hotmale.se" id="email">
            <label for="street">Adresse</label>
            <input type="text" name="street" placeholder="Gata" id="street">
            <label for="city">Ville</label>
            <input type="text" name="city" placeholder="City where you live" id="city">
            <label for="postalcode">Code postal</label>
            <input type="text" name="postalcode" placeholder="123 45" id="postalcode">
        </section>
        <section class="payment">
            <h2>Pay</h2>
            <label for="card-name">Nom carte</label>
            <input type="text" name="card-name" placeholder="Name of legitimate card owner" id="card-name">
            <label for="card-no">N° carte</label>
            <input type="text" name="card-no" placeholder="Stolen card number" id="card-no">
            <label for="date">Date</label>
            <input type="text" name="date" placeholder="MM/YY" id="date">
            <label for="cvc">CVC</label>
            <input type="text" name="cvc" placeholder="123" id="cvc">
        </section>
        <section>
            <input type="submit" value="Achetez !" class="pay">
        </section>
    </form>
</body>

</html>