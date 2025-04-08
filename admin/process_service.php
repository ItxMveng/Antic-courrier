<?php
require 'db.php';

$name = $_POST['name'];
$cellule_id = $_POST['cellule_id'];

$sql = "INSERT INTO structure (name, hierarchy_level, parent_id) VALUES (:name, 'Service', :cellule_id)";
$query = $db->prepare($sql);
$query->bindValue(":name", $name, PDO::PARAM_STR);
$query->bindValue(":cellule_id", $cellule_id, PDO::PARAM_INT);

if ($query->execute())
{
    echo "<script>alert('Service ajoutée avec succès'); window.location.href = 'orders.php';</script>";
} else {
    echo "<script>alert('Erreur lors de l\'ajout');</script>";
}
?>