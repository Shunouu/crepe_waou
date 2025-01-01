<?php
require_once __DIR__ . '/partials/header.php';
require_once('db.php');

if (isset($_SESSION['user_id'])) {
    header("Location: /product");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $erreur = null;

    if (empty($email) || empty($password)) {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nom'] = $user['nom'];
                $_SESSION['user_email'] = $user['email'];

                header("Location: /product");
                exit();
            } else {
                $erreur = "Le mot de passe est incorrect.";
            }
        } else {
            $erreur = "Aucun utilisateur trouvé avec cet email.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Connexion</title>
</head>
<body>
<div class="content">
    <h1>Connexion</h1>

    <?php if (isset($erreur)) : ?>
        <p style="color: red;"><?= htmlspecialchars($erreur); ?></p>
    <?php endif; ?>
    <main>
    <form action="/login" method="POST">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Se Connecter</button>
        </form>
    </main>
</body>
</html>