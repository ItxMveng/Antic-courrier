<?php
// Inclure la connexion à la base de données
require_once 'db.php'; // Remplacez par le nom de votre fichier de connexion

// Vérifier si un ID est passé dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'ID de l'utilisateur à supprimer
    $userId = (int) $_GET['id'];

    // Préparer la requête de suppression
    $stmt = $db->prepare('DELETE FROM users WHERE id = :id');

    // Exécuter la requête en passant l'ID de l'utilisateur
    $stmt->execute(['id' => $userId]);

    // Vérifier si la suppression a réussi
    if ($stmt->rowCount() > 0) {
        // Redirection après succès
        header('Location: settings.php'); // Redirigez vers une page de succès ou de confirmation
    } else {
        // Redirection en cas d'échec
        header('Location: error.php'); // Redirigez vers une page d'erreur si la suppression échoue
    }
} else {
    // Si aucun ID n'est passé, rediriger vers une page d'erreur
    header('Location: error.php');
}

exit();
