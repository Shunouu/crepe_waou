<?php
require_once __DIR__ . '/partials/header.php';
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

$nom_utilisateur = $_SESSION['user_nom'];

$stmt = $pdo->query("SELECT * FROM product");
$product_disponibles = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_produit'])) {
    $nom = trim($_POST['nom']);
    $description = trim($_POST['description']);
    $prix = trim($_POST['prix']);
    $image = trim($_POST['image']);

    $errors = [];
    if (empty($nom)) $errors[] = "Le nom du produit est obligatoire.";
    if (empty($description)) $errors[] = "La description du produit est obligatoire.";
    if (empty($prix) || !is_numeric($prix)) $errors[] = "Le prix est obligatoire et doit être un nombre valide.";

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO product (nom, description, prix, image) VALUES (:nom, :description, :prix, :image)");
        $stmt->execute([
            'nom' => $nom,
            'description' => $description,
            'prix' => $prix,
            'image' => $image,
        ]);

        $message = "Le produit a été ajouté avec succès.";
        header("Location: /dashboard");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1b1b1b;
            color: #fff;
        }

        nav {
            background-color: #000;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
        }

        nav a:hover {
            color: #ff9f1c;
        }

        .content {
            padding: 20px;
        }

        h1 {
            color: #ff9f1c;
        }

        .products-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product-item {
            background-color: #444;
            border: 2px solid #f4a424;
            padding: 2%;
            border-radius: 10px;
            width: calc(30% - 10px);
            box-sizing: border-box;
        }

        .product-item img {
            width: 60%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }

        .product-item strong {
            display: block;
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        form {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        input[type="text"], 
        input[type="number"], 
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #222;
            color: #fff;
        }

        input[type="submit"] {
            background-color: #f4a424;
            color: #111;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="content">

    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li style="color:red;"><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if (isset($message)): ?>
        <p style="color:green;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <h2>Produits disponibles</h2>
    <div class="products-container">
        <?php if (!empty($product_disponibles)): ?>
            <?php foreach ($product_disponibles as $product): ?>
                <div class="product-item">
                    <strong><?= htmlspecialchars($product['nom']) ?></strong> 
                    <p><?= htmlspecialchars($product['description']) ?></p>
                    <p><?= number_format($product['prix'], 2) ?> €</p>
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['nom']) ?>">
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="product-item">Aucun produit disponible.</div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php require_once __DIR__ . '/partials/footer.php'; ?>