<?php
// Inclure la connexion à la base de données
require_once 'db.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sender_id = $_POST['sender_id']; 
    $recipient_ids = $_POST['recipient_ids'];  
    $subject = $_POST['subject']; 
    $categorie = $_POST['categorie'];
    $type = $_POST['type'];
    $priorite = $_POST['priorite']; 
    
    // Gérer le fichier uploadé
    $target_dir = "uploads/";
    $file_name = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $file_name;
    
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // Insérer les informations dans la table file_transfers
        $stmt = $db->prepare('INSERT INTO file_transfers (sender_id, recipient_id, file_name, file_path, subject, categorie, type, priorite) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        
        foreach ($recipient_ids as $recipient_id) {
        $stmt->execute([$sender_id, $recipient_id, $file_name, $target_file, $subject, $categorie, $type, $priorite]);
        
    }
        echo "Le fichier a été envoyé avec succès.";
        // Redirection ou message de succès
        header('Location: docs.php');
    } else {
        echo "Erreur lors de l'envoi du fichier.";
    }
}
?>
