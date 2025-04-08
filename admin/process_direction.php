<?php
require 'db.php';

$name = $_POST['name'];

$sql = "INSERT INTO structure (name, hierarchy_level) VALUES (:name, 'Direction')";
$query = $db->prepare($sql);
$query->bindValue(":name", $name, PDO::PARAM_STR);

if ($query->execute()) {
    echo "<script>alert('Direction ajoutée avec succès'); window.location.href = 'orders.php';</script>";
} else {
    echo "<script>alert('Erreur lors de l\'ajout');</script>";
}
?>
