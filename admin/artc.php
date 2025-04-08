<?php
require "db.php";
// Vérification si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupération des données du formulaire
  $titre = htmlspecialchars($_POST['Titre_annonce']);
  $description = htmlspecialchars($_POST['Description_annonce']);
  $date = htmlspecialchars($_POST['Date_annonce']);
  
  // Gestion du fichier uploadé
  if (isset($_FILES['Document_annonce']) && $_FILES['Document_annonce']['error'] === UPLOAD_ERR_OK) {
      $document = $_FILES['Document_annonce'];
      $document_name = basename($document['name']);
      $document_path = 'uploads/' . $document_name;
      
      // Déplacement du fichier vers le dossier "uploads"
      if (move_uploaded_file($document['tmp_name'], $document_path)) {
          // Insertion des données dans la base de données
          $query = $db->prepare('INSERT INTO annonces (Titre_annonce, Description_annonce, Document_annonce, Date_annonce) VALUES (?, ?, ?, ?)');
          $query->execute([$titre, $description, $document_path, $date]);

          echo "Annonce publiée avec succès!";
          header('Location: help.php'); 
         
      } else {
          echo "Erreur lors du téléchargement du fichier.";
      }
  } else {
      echo "Veuillez sélectionner un fichier valide.";
  }
}
?>