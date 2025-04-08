<?php
session_start();

// Vérifier si l'utilisateur est connecté en vérifiant la présence de l'ID dans la session
if(!isset($_SESSION['id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('location: ../formulaire.php'); 
    exit(); // Arrêter l'exécution du script après la redirection
}

// Vous pouvez également vérifier le rôle pour s'assurer que c'est bien un admin
if($_SESSION['role'] !== 'sous-directeur') {
    // Rediriger vers une autre page ou afficher un message d'erreur si l'utilisateur n'est pas admin
    header('location: ../formulaire.php'); 
    exit();
}

// Récupérer la liste des utilisateurs pour le champ de sélection
require_once 'db.php';
$users = $db->query('SELECT id, username FROM users');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envoyer un Courrier</title>
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .animated-text {
            font-size: 1.2em;
            animation: fadeText 6s infinite;
        }

        @keyframes fadeText {
            0% { opacity: 0; }
            20% { opacity: 1; }
            80% { opacity: 1; }
            100% { opacity: 0; }
        }

        .image-block {
            text-align: center;
            margin-bottom: 20px;
        }

        .image-block img {
            max-width: 50%; /* Réduit la taille de l'image à 80% de sa taille d'origine */
            height: auto;
        }

        .text-block {
            margin-top: 20px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <!-- Bloc gauche avec image et textes animés -->
        <div class="col-md-6">
            <div class="image-block">
                <img src="images/a.jpg" alt="Image descriptive">
            </div>
            <div class="text-block">
                <p class="animated-text">Bienvenue sur la plateforme de gestion de courriers</p>
                <p class="animated-text">Envoyez et recevez des documents en toute sécurité</p>
                <p class="animated-text">Gérez vos priorités facilement</p>
            </div>
        </div>

        <!-- Bloc droit avec le formulaire d'envoi -->
        <div class="col-md-6">
            <div class="card">
            <div class="card-header text-white" style="background-color: #28a745;">
                    <h2 class="text-center">Envoyer un Courrier</h2>
                </div>
                <div class="card-body">
                    <form action="transfer.php" method="POST" enctype="multipart/form-data">
                        
                        <!-- Sélection du destinataire -->
                        <div class="form-group mb-3">
                            <label for="recipient_id">Destinataire:</label>
                            <select class="form-control" name="recipient_ids[]" id="recipient_ids" multiple="multiple" required>
                                <option value="" disabled selected>Sélectionner un utilisateur</option>
                                <?php while ($user = $users->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?= htmlspecialchars($user['id']); ?>">
                                        <?= htmlspecialchars($user['username']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <!-- Objet du courrier -->
                        <div class="form-group mb-3">
                            <label for="subject">Objet:</label>
                            <input type="text" class="form-control" name="subject" id="subject" required>
                        </div>
                        
                        <!-- Catégorie du courrier -->
                        <div class="form-group mb-3">
                            <label for="priorite">Catégorie:</label>
                            <select class="form-control" name="categorie" id="categorie" required>
                                <option value="" disabled selected>Choisir Une Catégorie</option>
                                <option value="Courrier Entrant">Courrier Entrant</option>
                                <option value="Courrier Sortant">Courrier Sortant</option>
                                <option value="Courrier Interne">Courrier Interne</option>
                            </select>
                        </div>

                        <!-- Type de courrier -->
                        <div class="form-group mb-3">
                            <label for="type">Type:</label>
                            <input type="text" class="form-control" name="type" id="type" required>
                        </div>

                        <!-- Priorité du courrier -->
                        <div class="form-group mb-3">
                            <label for="priorite">Priorité:</label>
                            <select class="form-control" name="priorite" id="priorite" required>
                                <option value="" disabled selected>Choisir une priorité</option>
                                <option value="Très Urgent">Très Urgent</option>
                                <option value="Urgent">Urgent</option>
                                <option value="Normal">Normal</option>
                            </select>
                        </div>

                        <!-- Fichier à joindre -->
                        <div class="form-group mb-3">
                            <label for="file">Fichier:</label>
                            <input type="file" class="form-control-file" name="file" id="file" required>
                        </div>
                        
                        <!-- Champ pour l'identifiant de l'expéditeur -->
                        <input type="hidden" name="sender_id" value="<?= $_SESSION['id']; ?>">
                        
                        <!-- Bouton d'envoi -->
                        <button type="submit" class="btn btn-block" style="background-color: #28a745; color: white;">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>  
<script>
$(document).ready(function() {
    $('#recipient_ids').select2({
        placeholder: "Sélectionner un ou plusieurs utilisateurs",
        allowClear: true
    });
});
</script>
</body>
</html>
