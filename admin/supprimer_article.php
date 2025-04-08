<?php
require "db.php";
if(isset($_GET['Id_annonce']) AND !empty($_GET['Id_annonce'])){
    $getid = $_GET['Id_annonce'];
    $recupArticle = $db->prepare('SELECT * FROM annonces WHERE Id_annonce = ?');
    $recupArticle->execute(array($getid));
    if($recupArticle->rowCount() > 0){
        $deleteArticle = $db->prepare('DELETE FROM annonces WHERE Id_annonce = ?');
        $deleteArticle->execute(array($getid));
        echo "Article supprimer";
        header('location: help.php'); 
}else{
    echo "Aucun article trouvé";
}
}else{
    echo "Aucun identifiant trouvé";
}
?>