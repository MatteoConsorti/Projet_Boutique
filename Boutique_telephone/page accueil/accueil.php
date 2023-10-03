<!DOCTYPE html>
<html>
<head>
    <script></script>
    <meta charset="UTF-8">
    <title>GemsPhones</title>
    <link rel="stylesheet" href="accueil.css">
    
</head>
<body>

<?php include "../header/header.html";?>
<div class='information-container'>
  <div class='inner-container'>
    <h1 class='section-title'>Information</h1>
    <div class='border'></div>
      <div class='service-container'>
        
       
        
        <div class='service-box'>
          <div class='service-icon'>
            <i class='fa fa-code'></i>
          </div>
          <div class='service-title'>GemsPhones</div>
          <div class='description'>
           GemsPhones c'est la référence des sites de reventes de téléphones. Avec nous, vous êtes certains de faire bonne affaire, tout en conservant votre porte monnaie. 
           N'hésitez plus un instant et charger votre panier
          </div>
        </div>

        <div class='service-box'>
          <div class='service-icon'>
            <i class='fa fa-paint-brush'></i>
          </div>
          <div class='service-title'>Catalogue de produits</div>
          <div class='description'>
            GemsPhones contient les meilleurs offres du marché en terme de prix avec une selection des meilleures marques. Soyez sur de retrouver votre téléphone du moment chez GemsPhones
          </div>
        </div>
        
        <div class='service-box'>
          <div class='service-icon'>
            <i class='fa fa-cut'></i>
          </div>
          <div class='service-title'>Ecoresponsable</div>
          <div class='description'>
            GemsPhones s'engage a planter un arbre à chaque achat d'un téléphone. Nous essayons tout comme vous à penser à notre planète.
          </div>
        </div>

        
      </div>
    </div>
  </div>
<main>


    <section class="promotions">
        <h2>Promotions</h2>
        <div class="article">
            <img id="img1" src="../images/xiaomi_mi_11_ultra.jpg" alt="article en promotion">
            <h3>Xiaomi 11 Ultra </h3>
            <p class="price">600 <del>700€</del></p>
            <a href="#" class="buy">Acheter</a>
        </div>
        <div class="article">
            <img id="img2" src="../images/Iphone13.jpg" alt="article en promotion">
            <h3>Iphone 13 Pro</h3>
            <p class="price">800€ <del>1300€</del></p>
            <a href="#" class="buy">Acheter</a>
        </div>
        <div class="article">
            <img id="img3" src="../images/google.webp" alt="article en promotion">
            <h3>Google Pixel 6 Pro</h3>
            <p class="price">500€ <del>799€</del></p>
            <a href="#" class="buy">Acheter</a>
        </div>
        <div class="article">
            <img id="img4" src="../images/sony.avif" alt="article en promotion">
            <h3>Sony Xperia 1 III</h3>
            <p class="price">800€ <del>850€</del></p>
            <a href="#" class="buy">Acheter</a>
        </div>
    </section>
</main>

	</body>
    <footer>
             <script src="script.js"></script> 
              
		
	</footer>
    <?php include "../footer/footer.html";?>
</html>