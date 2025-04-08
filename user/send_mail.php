<?php
// Inclure le fichier de connexion à la base de données
include 'db.php';

// Démarrer la session pour accéder aux informations de l'utilisateur connecté
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $sender_id = $_SESSION['id'];  // ID de l'utilisateur connecté
    $recipient_email = htmlspecialchars($_POST['Email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Vérifier que tous les champs sont remplis
    if (!empty($recipient_email) && !empty($subject) && !empty($message)) {
        // Préparer la requête SQL
        $sql = "INSERT INTO courriers (sender_id, recipient_email, subject, message) 
                VALUES (:sender_id, :recipient_email, :subject, :message)";

        // Préparer l'exécution de la requête
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':sender_id', $sender_id);
        $stmt->bindParam(':recipient_email', $recipient_email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);

        // Exécuter la requête et vérifier si elle a réussi
        if ($stmt->execute()) {
            echo "Le Courrier a été envoyé avec succès.";
        // Redirection ou message de succès
        header('Location: orders.php');
        } else {
            echo "Erreur lors de l'envoi du Courrier";
        // Redirection ou message de succès
        header('Location: orders.php');
        }
    } else {
        echo "Tout les champs sont obligatoires";
        // Redirection ou message de succès
        header('Location: orders.php');
    }
}
?>
