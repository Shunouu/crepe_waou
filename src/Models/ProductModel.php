<?php

namespace App\Models;

use PDO;
use PDOException;

class ProductModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllProducts()
    {
        try {
            $query = $this->db->query("SELECT * FROM products");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getProductById($id)
    {
        try {
            $query = $this->db->prepare("SELECT * FROM products WHERE id = :id");
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function addProduct($name, $price, $description)
    {
        try {
            $query = $this->db->prepare("INSERT INTO products (name, price, description) VALUES (:name, :price, :description)");
            $query->bindParam(':name', $name);
            $query->bindParam(':price', $price);
            $query->bindParam(':description', $description);
            return $query->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}