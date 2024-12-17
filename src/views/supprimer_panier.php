<?php
session_start();

if (isset($_POST['id'])) {
    $id_supprime = $_POST['id'];

    foreach ($_SESSION['panier'] as $index => $produit) {
        if ($produit['id'] == $id_supprime) {
            unset($_SESSION['panier'][$index]);
            break;
        }
    }

    $_SESSION['panier'] = array_values($_SESSION['panier']);
}

header('Location: panier');
exit;
?>