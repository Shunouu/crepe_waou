<?php require_once __DIR__ . '/partials/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Site E-Commerce</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

    <section class="hero">
        <div class="hero-slider">
            <div class="slide">
                <div class="slide-text">
                    <h1>Bienvenue sur notre site</h1>
                    <p>Découvrez des CD, DVD et accessoires</p>
                    <a href="/categories" class="btn">Découvrir notre gamme</a>
                    <div class="animated-shape"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <h2>Les atouts du magasin</h2>
        <div class="features-container">
            <div class="feature-item">
                <img src="/image/conseil.jpg" alt="Conseils">
                <h3>Conseils</h3>
                <p>Écoute, conseils dans le choix d'un instrument et partitions adaptés à vos besoins.</p>
            </div>
            <div class="feature-item">
                <img src="/image/service.jpg" alt="Services">
                <h3>Services</h3>
                <p>Réparations, entretien, et assistance technique.</p>
            </div>
            <div class="feature-item">
                <img src="/image/produit.jpg" alt="Gamme de produits" class="flipped" style="transform: scaleX(-1);">
                <h3>Gamme de produits</h3>
                <p>CD, DVD, partitions et accessoires adaptés à tous vos besoins musicaux.</p>
            </div>
        </div>
    </section> 

</body>
</html>

<?php require_once __DIR__ . '/partials/footer.php'; ?>