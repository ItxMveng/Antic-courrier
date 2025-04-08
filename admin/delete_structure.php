<?php
// Inclure la connexion à la base de données
require_once 'db.php'; // Remplacez par le nom de votre fichier de connexion

// Vérifier si l'ID a été passé via la méthode GET
if (isset($_GET['id'])) {
    // Récupérer l'ID de la structure à supprimer
    $id = intval($_GET['id']);
    
    // Préparer la requête SQL pour supprimer la structure
    $stmt = $db->prepare('DELETE FROM structure WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    // Exécuter la requête
    if ($stmt->execute()) {
        // Redirection après succès de la suppression
        header('Location: orders.php?success=1');
        exit();
    } else {
        // Redirection en cas d'échec de la suppression
        header('Location: orders.php?error=1');
        exit();
    }
} else {
    // Redirection si l'ID n'a pas été fourni
    header('Location: orders.php?error=2');
    exit();
}
?>
