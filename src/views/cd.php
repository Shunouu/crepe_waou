<?php
session_start();

$produits_disponibles = [
    1 => [
        'nom' => 'Bad',
        'artiste' => 'Michael Jackson',
        'prix' => 15.00,
        'description' => 'L\'album légendaire de Michael Jackson, avec des hits incontournables comme "Smooth Criminal", "Man in the Mirror", et "Bad".',
        'image' => '/image/cd_1.jpg'
    ],
    2 => [
        'nom' => 'Illmatic',
        'artiste' => 'Nas',
        'prix' => 14.00,
        'description' => 'Un album incontournable, considéré comme l\'un des meilleurs albums de rap de tous les temps, avec des paroles percutantes et un flow unique.',
        'image' => '/image/cd_2.jpg'
    ],
    3 => [
        'nom' => 'Starboy',
        'artiste' => 'The Weeknd',
        'prix' => 13.50,
        'description' => 'Un album novateur de The Weeknd, fusionnant R&B, pop et électronique, avec des hits comme "Starboy" et "I Feel It Coming".',
        'image' => '/image/cd_3.jpg'
    ],
    4 => [
        'nom' => 'Ready to Die',
        'artiste' => 'The Notorious B.I.G.',
        'prix' => 14.50,
        'description' => 'Le premier album de Biggie Smalls, un mélange d\'histoires personnelles et de morceaux emblématiques du rap East Coast.',
        'image' => '/image/cd_4.jpg'
    ],
    5 => [
        'nom' => 'The Miseducation of Lauryn Hill',
        'artiste' => 'Lauryn Hill',
        'prix' => 16.00,
        'description' => 'Un album emblématique mélangeant soul, R&B et rap, avec des morceaux intemporels comme "Doo Wop (That Thing)" et "Ex-Factor".',
        'image' => '/image/cd_5.jpg'
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
  <title>CD - Site E-Commerce</title>
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
    <h1>Nos CDs</h1>
    <div class="produits">
        <?php foreach ($produits_disponibles as $id => $produit): ?>
            <div class="product-item">
                <h2><?php echo $produit['nom']; ?></h2>
                <img src="<?php echo $produit['image']; ?>" alt="<?php echo $produit['nom']; ?>" width="150">
                <p><strong>Artiste :</strong> <?php echo $produit['artiste']; ?></p>
                <p><strong>Description :</strong> <?php echo $produit['description']; ?></p>
                <p><strong>Prix :</strong> €<?php echo number_format($produit['prix'], 2); ?></p>
                <form action="" method="get">
                    <label for="quantite">Quantité :</label>
                    <input type="number" name="quantite" id="quantite" value="1" min="1">
                    <button type="submit" name="add" value="<?php echo $id; ?>">Ajouter au panier</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>