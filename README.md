# Antic-courrier

**ANTIC COURRIER** est une application web de gestion électronique du courrier, développée avec **HTML**, **CSS**, **Bootstrap**, **JavaScript**, **PHP** et **MySQL**.  
Elle permet la gestion des courriers entrants et sortants au sein d'une structure hiérarchisée (Direction, Département, Cellule, Service), avec envoi de fichiers, notifications, gestion des utilisateurs par rôles, et signature numérique.

---

## Fonctionnalités principales

- Ajout et gestion des utilisateurs (admin, directeur, sous-directeur, employé)
- Ajout de structures hiérarchiques : direction, département, cellule, service
- Envoi de courriers (fichiers PDF, Word, Excel, etc.)
- Réception et consultation des courriers reçus
- Notification de nouveaux courriers
- Signature et cachet numériques
- Interface utilisateur responsive avec Bootstrap

---

## Technologies utilisées

- **Frontend** : HTML5, CSS3, Bootstrap 5, JavaScript
- **Backend** : PHP (version 7+)
- **Base de données** : MySQL
- **Serveur local recommandé** : WAMP / XAMPP

---

## Installation et utilisation

### 1. Cloner le projet
git clone https://github.com/ItxMveng/antic-courrier.git

### 2. Copier le dossier dans votre serveur local
Exemple : C:/wamp64/www/antic-courrier

### 3. Configurer la base de données
Créez une base de données MySQL nommée antic_courrier
Importez le fichier antic_courrier.sql depuis PhpMyAdmin ou via la ligne de commande

### 4. Configuration du fichier de connexion
Dans le fichier config.php ou équivalent, assurez-vous que les informations suivantes sont correctes :
$serveur = "localhost";
$name = "antic";
$user = "root";
$pass = "";

### 5. Lancer le projet
Ouvrez votre navigateur et accédez à :
http://localhost/antic

Connecter avec le compte administrateur pour pouvoir gerer l'integraliter du projet et creer les differents comptes:
email: admin@gmail.com
mot de passe: 123456

Structure des rôles utilisateurs
Admin : Gère les structures et les utilisateurs
Directeur : Envoie et reçoit des courriers liés à sa direction
Sous-directeur : Reçoit ou transmet des courriers liés à son département
Employé : Gère les courriers de son service

### Auteur
Développé par : Itoua Mveng Victor Francis
Email : francisitoua05@gmail.com
GitHub : https://github.com/ItxMveng

### Licence
Ce projet est à but éducatif et professionnel.
N'hésitez pas à le forker, l'améliorer ou proposer des issues !
