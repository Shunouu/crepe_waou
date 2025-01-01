<?php
session_start();

$produits_disponibles = [
    [
        'id' => 6,
        'nom' => 'Sister Act 2',
        'prix' => 10.50,
        'description' => 'Une comédie musicale touchante où Whoopi Goldberg aide une chorale d\'école à retrouver sa passion pour la musique.',
        'image' => '/image/dvd_1.jpg'
    ],
    [
        'id' => 7,
        'nom' => 'Straight Outta Compton',
        'prix' => 12.00,
        'description' => 'Un film biographique racontant l\'ascension du groupe légendaire de rap N.W.A et leur impact culturel.',
        'image' => '/image/dvd_2.jpg'
    ],
    [
        'id' => 8,
        'nom' => '8 Mile',
        'prix' => 9.00,
        'description' => 'Le parcours inspirant d\'un jeune rappeur, incarné par Eminem, qui cherche à faire ses preuves dans le monde du rap.',
        'image' => '/image/dvd_3.jpg'
    ],
    [
        'id' => 9,
        'nom' => 'The Greatest Showman',
        'prix' => 10.00,
        'description' => 'Un film musical spectaculaire avec Hugh Jackman, retraçant l\'histoire de P.T. Barnum et la création du cirque moderne.',
        'image' => '/image/dvd_4.jpg'
    ],
    [
        'id' => 10,
        'nom' => 'Bohemian Rhapsody',
        'prix' => 13.00,
        'description' => 'Un biopic émouvant sur Freddie Mercury et le groupe Queen, célébrant leur musique et leur impact culturel.',
        'image' => '/image/dvd_5.jpg'
    ]
];

if (isset($_GET['add'])) {
    $id = $_GET['add'];
    $quantite = isset($_GET['quantite']) ? (int) $_GET['quantite'] : 1;
    if ($quantite > 0) {
        $_SESSION['panier'][$id] = ($quantite + ($_SESSION['panier'][$id] ?? 0));
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DVD - Site E-Commerce</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
    <nav class="navbar">
        <div class="logo">
            <img src="/image/logo.jpg" alt="Logo">
        </div>
        <ul class="nav-links">
            <li><a href="/">Accueil</a></li>
            <li><a href="/cd">CD</a></li>
            <li><a href="/dvd">DVD</a></li>
            <li><a href="/accessoires">Accessoires</a></li>
            <li><a href="/panier">Panier</a></li>
        </ul>
        <div class="auth-links">
            <?php if (isset($_SESSION['user_nom'])): ?>
                <span>Bienvenue, <?= htmlspecialchars($_SESSION['user_nom']); ?> !</span>
                <a href="/logout" class="logout-btn">Déconnexion</a>
            <?php else: ?>
                <a href="/login" class="login-btn">Connexion</a>
                <a href="/formulaire" class="register-btn">S'inscrire</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main>
    <h1>Nos DVDs</h1>
    <div class="produits">
        <?php foreach ($produits_disponibles as $id => $produit): ?>
            <div class="product-item">
                <h2><?php echo $produit['nom']; ?></h2>
                <img src="<?php echo $produit['image']; ?>" alt="<?php echo $produit['nom']; ?>" width="150">
                <p><?php echo $produit['description']; ?></p>
                <p><strong>Prix : €<?php echo number_format($produit['prix'], 2); ?></strong></p>
                <form action="" method="get">
                    <input type="hidden" name="add" value="<?php echo $produit['id']; ?>">
                    <label for="quantite">Quantité :</label>
                    <input type="number" name="quantite" id="quantite" value="1" min="1">
                    <button type="submit">Ajouter au panier</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>