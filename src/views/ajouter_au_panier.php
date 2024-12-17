<?php
session_start();
if (!$con) die('Erreur : ' . mysqli_connect_errno());  

if (!isset($_SESSION['panier'])) {  
    $_SESSION['panier'] = array();
}

if (!isset($_SESSION['id'])) {
    $id = $_GET['id'];
    $produit = mysqli_query($con, "SELECT * FROM produits WHERE id=$id");
    if (empty(mysqli_fetch_assoc($produit))) {
        die("Ce produit n'existe pas");
    }
   
    if (!isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id] = 1; 
    } else {
        $_SESSION['panier'][$id]++;  
    }
}
?>