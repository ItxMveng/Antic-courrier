<?php
// Inclure la connexion à la base de données
require_once 'db.php'; // Remplacez par le nom de votre fichier de connexion

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $username = htmlspecialchars($_POST['username']);
    $name = htmlspecialchars($_POST['name']);
    $Email = htmlspecialchars($_POST['Email']);
    $Mdp = password_hash($_POST['Mdp'], PASSWORD_DEFAULT); // Hachage du mot de passe
    $role = htmlspecialchars($_POST['role']);
    $service_id = htmlspecialchars($_POST['service_id']);
    
    // Générer la date et l'heure actuelles
    $created_at = date('Y-m-d H:i:s');
    
    // Préparer et exécuter la requête d'insertion
    $stmt = $db->prepare('
        INSERT INTO users (username, name, Email, Mdp, role, service_id, created_at)
        VALUES (:username, :name, :Email, :Mdp, :role, :service_id, :created_at)
    ');
    
    // Exécuter la requête avec les données du formulaire
    $stmt->execute([
        'username' => $username,
        'name' => $name,
        'Email' => $Email,
        'Mdp' => $Mdp,
        'role' => $role,
        'service_id' => $service_id,
        'created_at' => $created_at
    ]);

    // Redirection ou message de succès
    header('Location: settings.php'); // Rediriger vers une page de succès ou d'accueil
    exit();
}
?>
