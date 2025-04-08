<?php
session_start();

$Email = $_POST['Email'];
 $Mdp = $_POST['Mdp'];

require "db.php";

// Préparation de la requête pour récupérer l'utilisateur avec le rôle
$req = $db->prepare('SELECT ID, Email, Mdp, role FROM users WHERE Email = :Email');
$req->execute(array('Email' => $Email));
$resultat = $req->fetch();

if ($resultat && password_verify($Mdp, $resultat['Mdp'])) {
    // Stocker l'ID et le rôle de l'utilisateur dans la session
    $_SESSION['id'] = $resultat['ID'];
    $_SESSION['role'] = $resultat['role'];
    $_SESSION['Email'] = $resultat['Email'];
    
    // Redirection en fonction du rôle
    switch ($resultat['role']) {
        case 'admin':
            header('Location: ./admin/index.php');
            break;
        case 'directeur-general':
            header('Location: ./directeurG/index.php');
            break;
        case 'directeur':
            header('Location: ./directeur/index.php');
            break;
        case 'sous-directeur':
            header('Location: ./Sdirecteur/index.php');
            break;
        case 'chef-service':
            header('Location: ./service/index.php');
            break;
        case 'initiateur':
            header('Location: ./user/index.php');
            break;
        default:
            header('Location: index.php');
            break;
    }
    echo "<script>alert('Connexion réussie');</script>";
} else {
    echo 'Mauvais identifiant ou mot de passe !';
}
?>
