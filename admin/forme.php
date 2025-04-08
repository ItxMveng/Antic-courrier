<?php
// Inclure la connexion à la base de données
require_once 'db.php'; // Remplacez par le nom de votre fichier de connexion

// Récupérer les services depuis la base de données
$services = $db->query('SELECT id, name FROM structure WHERE hierarchy_level = "Service"');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire | Antic</title>
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
   
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <!-- Bloc gauche avec image et textes animés -->
        <div class="col-md-6">
            <div class="image-block">
                <img src="assets/images/a.jpg" alt="Image descriptive">
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
                    <h2 class="text-center">Ajouter Un utilisateur</h2>
                </div>
                <div class="card-body">
                    <form action="inscrit.php" method="POST" enctype="multipart/form-data">
                        
                        
                   
                        <!-- Objet du courrier -->
                        <div class="form-group mb-3">
                            <label for="subject">Nom:</label>
                            <input class="form-control"  type="text" placeholder="Nom" name="username" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="subject">Prénom:</label>
                            <input class="form-control" id="txt-input" type="text" placeholder="Prenom" name="name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="subject">Email:</label>
                            <input class="form-control" id="txt-input" type="mail" placeholder="Email" name="Email" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="subject">Mot de passe:</label>
                            <input class="form-control" type="password" placeholder="Mot de passe" id="pwd" name="Mdp" required>
                        </div>
                        
                        <div class="form-group mb-3">
                        <select class="form-control" name="role" required>
                    <option value="" disabled selected>Sélectionner le rôle</option>
                    <option value="directeur-general">Directeur General</option>
                    <option value="directeur">Directeur</option>
                    <option value="sous-directeur">Sous-Directeur</option>
                    <option value="chef-service">Chefs Service</option>
                    <option value="initiateur">Initiateur</option>
                    </select>
                    </div>

                    <div class="form-group mb-3">
                    <select class="form-control" name="service_id" required>
                    <option value="" disabled selected>Sélectionner le service</option>
                    <?php while ($service = $services->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?= htmlspecialchars($service['id']); ?>">
                            <?= htmlspecialchars($service['name']); ?>
                        </option>
                    <?php } ?>
                </select>
                </div>
               
                        <div class="form-group mb-3">
                        <input class="form-control" id="created_at" type="text" placeholder="Date de création" name="created_at" readonly>
                        </div>
                    
                        
                        <!-- Bouton d'envoi -->
                        <button type="submit" class="btn btn-block" style="background-color: #28a745; color: white;">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>  

<script>
    // Set the current date and time in the created_at field
    document.getElementById('created_at').value = new Date().toLocaleString();
</script>

<script src="../js/form.js"></script>
</body>
</html>

