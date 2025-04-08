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

        <div class="col-md-6" style='margin-top:75px;'>
            <div class="card" style='margin-top:125px;'>
            <div class="card-header text-white" style="background-color: #28a745;">
        <h1>Ajouter une Cellule</h1>
        </div>
        <div class="card-body">

        <form method="POST" action="process_cellule.php">
            <div class="form-group">
                <label for="name">Nom de la Cellule</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="departement">Département</label>
                <select id="departement" name="departement_id" required>
                <?php
                    require 'db.php';
                    $query = $db->query("SELECT id, name FROM structure WHERE hierarchy_level = 'Département'");
                    
                    if (!$query) {
                        die("Erreur de requête SQL : " . implode(":", $db->errorInfo()));
                    }

                    while ($departement = $query->fetch()) {
                        echo "<option value='{$departement['id']}'>{$departement['name']}</option>";
                    }
                    ?>
                </select>
            </div>
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
