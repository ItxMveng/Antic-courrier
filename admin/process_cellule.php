<?php
require 'db.php';

$name = $_POST['name'];
$departement_id = $_POST['departement_id'];

$sql = "INSERT INTO structure (name, hierarchy_level, parent_id) VALUES (:name, 'Cellule', :departement_id)";
$query = $db->prepare($sql);
$query->bindValue(":name", $name, PDO::PARAM_STR);
$query->bindValue(":departement_id", $departement_id, PDO::PARAM_INT);

if ($query->execute()) {
    echo "<script>alert('Cellule ajoutée avec succès'); window.location.href = 'orders.php';</script>";
} else {
    echo "<script>alert('Erreur lors de l\'ajout');</script>";
}
?>
