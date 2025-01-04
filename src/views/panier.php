<?php
session_start();

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    unset($_SESSION['panier'][$id]);
}

if (isset($_GET['add'])) {
    $id = $_GET['add'];
    $quantite = $_SESSION['panier'][$id] ?? 0;
    $_SESSION['panier'][$id] = $quantite + 1;
}

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
    ],
    6 => [
        'nom' => 'Sister Act 2',
        'prix' => 10.50,
        'description' => 'Une comédie musicale touchante où Whoopi Goldberg aide une chorale d\'école à retrouver sa passion pour la musique.',
        'image' => '/image/dvd_1.jpg'
    ],
    7 => [
        'nom' => 'Straight Outta Compton',
        'prix' => 12.00,
        'description' => 'Un film biographique racontant l\'ascension du groupe légendaire de rap N.W.A et leur impact culturel.',
        'image' => '/image/dvd_2.jpg'
    ],
    8 => [
        'nom' => '8 Mile',
        'prix' => 9.00,
        'description' => 'Le parcours inspirant d\'un jeune rappeur, incarné par Eminem, qui cherche à faire ses preuves dans le monde du rap.',
        'image' => '/image/dvd_3.jpg'
    ],
    9 => [
        'nom' => 'The Greatest Showman',
        'prix' => 10.00,
        'description' => 'Un film musical spectaculaire avec Hugh Jackman, retraçant l\'histoire de P.T. Barnum et la création du cirque moderne.',
        'image' => '/image/dvd_4.jpg'
    ],
    10 => [
        'nom' => 'Bohemian Rhapsody',
        'prix' => 13.00,
        'description' => 'Un biopic émouvant sur Freddie Mercury et le groupe Queen, célébrant leur musique et leur impact culturel.',
        'image' => '/image/dvd_5.jpg'
    ],
    11 => [
        'nom' => 'Casque Audio - Sony',
        'prix' => 25.00,
        'description' => 'Découvrez une qualité audio exceptionnelle avec ce casque Sony. Il est idéal pour écouter de la musique et son design ergonomique garantit un confort optimal.',
        'image' => '/image/accessoire_1.jpg'
    ],
    12 => [
        'nom' => 'Chargeur Universel - Samsung',
        'prix' => 15.50,
        'description' => 'Ce chargeur universel rapide de Samsung est parfait pour recharger vos appareils en un temps record. Compatible avec la plupart des smartphones et tablettes.',
        'image' => '/image/accessoire_2.jpg'
    ],
    13 => [
        'nom' => 'Support de Téléphone - Apple',
        'prix' => 10.00,
        'description' => 'Maintenez votre téléphone en toute sécurité grâce à ce support robuste et élégant signé Apple. Il est parfait pour regarder des vidéos ou utiliser votre GPS.',
        'image' => '/image/accessoire_3.jpg'
    ],
    14 => [
        'nom' => 'Enceinte Bluetooth - JBL',
        'prix' => 35.00,
        'description' => 'Profitez d\'un son puissant et clair avec cette enceinte Bluetooth portable JBL. Idéale pour écouter de la musique en extérieur, elle offre une autonomie prolongée.',
        'image' => '/image/accessoire_4.jpg'
    ],
    15 => [
        'nom' => 'Adaptateur HDMI - Belkin',
        'prix' => 12.50,
        'description' => 'Connectez facilement vos appareils grâce à cet adaptateur HDMI de Belkin. Compatible avec les téléviseurs et les consoles de jeux.',
        'image' => '/image/accessoire_5.jpg'
    ]
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - Site E-Commerce</title>
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
                <a href="/product" style="text-decoration: none; color: inherit;">
                    Bienvenue, <?= htmlspecialchars($_SESSION['user_nom']); ?> !
                </a>
                <a href="/logout" class="logout-btn">Déconnexion</a>
            <?php else: ?>
                <a href="/login" class="login-btn">Connexion</a>
                <a href="/formulaire" class="register-btn">S'inscrire</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main>
    <h1>Votre Panier</h1>

    <?php if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['panier'] as $id => $quantite):
                    if (isset($produits_disponibles[$id])):
                        $produit = $produits_disponibles[$id];
                        $prix_total = $produit['prix'] * $quantite;
                        $total += $prix_total;
                ?>
                <tr>
                    <td>
                        <img src="<?= $produit['image']; ?>" alt="<?= $produit['nom']; ?>" width="50">
                        <?= $produit['nom']; ?>
                    </td>
                    <td><?= $quantite; ?></td>
                    <td>€<?= number_format($produit['prix'], 2); ?></td>
                    <td>
                        <form action="" method="get">
                            <input type="hidden" name="del" value="<?= $id; ?>">
                            <button type="submit" class="btn-supprimer">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><strong>Total : €<?= number_format($total, 2); ?></strong></p>
    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>