<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $direction_id = $_POST['direction_id'];
    
    try {
        // Insérer le département dans la table structure
        $stmt = $db->prepare("INSERT INTO structure (name, hierarchy_level, parent_id) VALUES (?, 'Département', ?)");
        $stmt->execute([$name, $direction_id]);

        // Trouver l'ID du département inséré pour l'afficher si nécessaire
        $departement_id = $db->lastInsertId();

        // Optionnel : Ajouter le département à une autre table si nécessaire
        // Exemple : insérer dans la table `departement` si elle existe

        echo "<script>alert('Departement ajoutée avec succès'); window.location.href = 'orders.php';</script>";
    } catch (PDOException $e) {
        die("Erreur d'insertion : " . $e->getMessage());
    }
}
?>
