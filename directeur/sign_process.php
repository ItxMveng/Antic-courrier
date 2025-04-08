<?php
// Inclure la connexion à la base de données
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $user_id = $_POST['user_id'];
    $file_transfer_id = $_POST['file_transfer_id'];
    $signature = $_POST['signature'];

    // Insertion de la signature numérique dans la base de données
    $stmt = $db->prepare('INSERT INTO digital_signatures (user_id, file_transfer_id, signature) VALUES (?, ?, ?)');
    $stmt->execute([$user_id, $file_transfer_id, $signature]);

    // Rediriger vers la page de confirmation ou autre
    header('Location: docs.php');
    exit();
}
?>
