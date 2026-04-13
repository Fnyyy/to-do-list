<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=larapel', 'root', '');
    echo "Database connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
