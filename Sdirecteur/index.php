<?php
session_start();

// Vérifier si l'utilisateur est connecté en vérifiant la présence de l'ID dans la session
if (!isset($_SESSION['id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('location: ../formulaire.php');
    exit(); // Arrêter l'exécution du script après la redirection
}

// Vérifier le rôle pour s'assurer que l'utilisateur est bien un sous-directeur
if ($_SESSION['role'] !== 'sous-directeur') {
    // Rediriger vers une autre page ou afficher un message d'erreur si l'utilisateur n'est pas sous-directeur
    header('location: ../formulaire.php');
    exit();
}

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION['id'];

// Connexion à la base de données
require_once 'db.php';

// Requête SQL pour récupérer les courriers reçus par l'utilisateur
$query = $db->prepare('
    SELECT
        ft.id,
        ft.sender_id,
        ft.recipient_id,
        ft.file_name,
        ft.file_path,
        ft.subject,
		ft.type,
        ft.categorie,
		ft.priorite,
        ft.created_at,
        s.username AS sender_name,
        str.name AS sender_structure
    FROM
        file_transfers ft
    JOIN users s ON ft.sender_id = s.id
    JOIN structure str ON s.service_id = str.id
    WHERE
        ft.recipient_id = ?
');

$query->bindParam(1, $user_id, PDO::PARAM_INT);
$query->execute();
$received_mails = $query->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="fr"> 
<head>
    <title>Sous directeur | Antic</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
        <div class="app-header-inner">  
	        <div class="container-fluid py-2">
		        <div class="app-header-content"> 
		            <div class="row justify-content-between align-items-center">
			        
				    <div class="col-auto">
					    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
						    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
					    </a>
				    </div><!--//col-->
		            <div class="search-mobile-trigger d-sm-none col">
			            <i class="search-mobile-trigger-icon fas fa-search"></i>
			        </div><!--//col-->
		            <div class="app-search-box col">
		                <form class="app-search-form">   
							<input type="text" placeholder="Search..." name="search" class="form-control search-input">
							<button type="submit" class="btn search-btn btn-primary" value="Search"><i class="fas fa-search"></i></button> 
				        </form>
		            </div><!--//app-search-box-->
		            
		            <div class="app-utilities col-auto">
			            <div class="app-utility-item app-notifications-dropdown dropdown">    
				            <a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle" data-bs-toggle="dropdown" href="orders.php" role="button" aria-expanded="false" title="Notifications">
					            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z"/>
  <path fill-rule="evenodd" d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
</svg>
					            
					        </a><!--//dropdown-toggle-->
					        
					        <div class="dropdown-menu p-0" aria-labelledby="notifications-dropdown-toggle">
					            
						        <div class="dropdown-menu-content">
							       
							       
							       
						        </div><!--//dropdown-menu-content-->
						        
						       
															
							</div><!--//dropdown-menu-->					        
				        </div><!--//app-utility-item-->
			            
			            
			            <div class="app-utility-item app-user-dropdown dropdown">
				            <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="assets/images/login.png" alt="user profile"></a>
				            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
								<li><a class="dropdown-item" href="account.php">Compte</a></li>
								<li><a class="dropdown-item" href="settings.php">Paramètre</a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="decon_admin.php">Déconnexion</a></li>
							</ul>
			            </div><!--//app-user-dropdown--> 
		            </div><!--//app-utilities-->
		        </div><!--//row-->
	            </div><!--//app-header-content-->
	        </div><!--//container-fluid-->
        </div><!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel"> 
	        <div id="sidepanel-drop" class="sidepanel-drop"></div>
	        <div class="sidepanel-inner d-flex flex-column">
		        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
		        <div class="app-branding">
		            <a class="app-logo" href="index.php"><img class="logo-icon me-2" src="assets/images/antic.png" alt="logo"><span class="logo-text">Antic - Courrier</span></a>
	
		        </div><!--//app-branding-->  
		        
			    <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
				    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
					    <li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link active" href="index.php">
						        <span class="nav-icon">
						        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		  <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
		  <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
		</svg>
						         </span>
		                         <span class="nav-link-text">Accueil</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    <li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link" href="docs.php">
						        <span class="nav-icon">
						        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
  <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/>
</svg>
						         </span>
		                         <span class="nav-link-text">Ajouter Un Courrier</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    <li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link" href="orders.php">
						        <span class="nav-icon">
						        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
  <circle cx="3.5" cy="5.5" r=".5"/>
  <circle cx="3.5" cy="8" r=".5"/>
  <circle cx="3.5" cy="10.5" r=".5"/>
</svg>
						         </span>
		                         <span class="nav-link-text">Rediger Un Courrier</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    <li class="nav-item has-submenu">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
						        <span class="nav-icon">
						        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
						        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	  <path fill-rule="evenodd" d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z"/>
	  <path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z"/>
	</svg>
						         </span>
		                         <span class="nav-link-text">Comptes</span>
		                         <span class="submenu-arrow">
		                             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
	</svg>
	                             </span><!--//submenu-arrow-->
					        </a><!--//nav-link-->
					        <div id="submenu-1" class="collapse submenu submenu-1" data-bs-parent="#menu-accordion">
						        <ul class="submenu-list list-unstyled">
									
							     
							        <li class="submenu-item"><a class="submenu-link" href="account.php">Mon Compte</a></li>
							        <li class="submenu-item"><a class="submenu-link" href="settings.php">Paramètres</a></li>
						        </ul>
					        </div>
					    </li>
					   
					   
					    
					    <li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link" href="help.php">
						        <span class="nav-icon">
						        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-question-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
						         </span>
		                         <span class="nav-link-text">Notes</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->					    
				    </ul><!--//app-menu-->
			    </nav><!--//app-nav-->
			    
		       
	        </div><!--//sidepanel-inner-->
	    </div><!--//app-sidepanel-->
    </header><!--//app-header-->
	<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="display-4">Accueil</h1>
            </div>
            <div class="container mt-4">
                <h2 class="text-center mb-4">Courriers Reçus</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #28a745; color: white;">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Expéditeur</th>
                                <th scope="col">Structure</th>
                                <th scope="col">Objet</th>
                                <th scope="col">Catégorie</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date de Réception</th>
                                <th scope="col">Priorité</th>
                                <th scope="col">Fichier</th>
                                <th scope="col">Imprimer</th>
                            </tr>
                        </thead>
                        <tbody id="mailTable">
                            <?php foreach ($received_mails as $index => $mail) { 
                                // Determine the priority styling
                                $priorityStyle = '';
                                switch ($mail['priorite']) {
                                    case 'Très Urgent':
                                        $priorityStyle = 'badge bg-danger'; // Red badge for Très Urgent
                                        break;
                                    case 'Urgent':
                                        $priorityStyle = 'badge bg-warning'; // Orange badge for Urgent
                                        break;
                                    case 'Normal':
                                        $priorityStyle = 'badge bg-success'; // Green badge for Normal
                                        break;
                                }
                            ?>
                                <tr class="<?= $index % 2 == 0 ? 'table-light' : 'table-secondary'; ?>">
                                    <td><?= htmlspecialchars($mail['id']); ?></td>
                                    <td><?= htmlspecialchars($mail['sender_name']); ?></td>
                                    <td><?= htmlspecialchars($mail['sender_structure']); ?></td>
                                    <td><?= htmlspecialchars($mail['subject']); ?></td>
                                    <td><?= htmlspecialchars($mail['categorie']); ?></td>
                                    <td><?= htmlspecialchars($mail['type']); ?></td>
                                    <td><?= htmlspecialchars($mail['created_at']); ?></td>
                                    <td>
                                        <span class="<?= $priorityStyle; ?>" style="padding: 5px 10px; font-size: 0.9em; border-radius: 12px;">
                                            <?= htmlspecialchars($mail['priorite']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= htmlspecialchars($mail['file_path']); ?>" download class="btn btn-success btn-sm" style="background-color: #28a745; border-color: #28a745;">
                                            <?= htmlspecialchars($mail['file_name']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm" style="background-color: #28a745; border-color: #28a745;" onclick="printFile('<?= htmlspecialchars($mail['file_path']); ?>')">
                                            Imprimer
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <div class="d-flex justify-content-between">
                        <span class="page-number align-self-center">Page: <span id="currentPage">1</span></span>
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Précédent</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Suivant</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript function to handle pagination (basic example)
    function paginateTable() {
        const rowsPerPage = 5;
        const table = document.getElementById('mailTable');
        const rows = table.getElementsByTagName('tr');
        const totalRows = rows.length;
        const pageCount = Math.ceil(totalRows / rowsPerPage);
        const currentPageSpan = document.getElementById('currentPage');

        // Hide all rows initially
        for (let i = 0; i < totalRows; i++) {
            rows[i].style.display = 'none';
        }

        // Show the first page of rows
        for (let i = 0; i < rowsPerPage; i++) {
            if (rows[i]) {
                rows[i].style.display = '';
            }
        }

        // Pagination controls
        const pagination = document.querySelector('.pagination');
        pagination.innerHTML = ''; // Clear previous pagination
        for (let i = 0; i < pageCount; i++) {
            const li = document.createElement('li');
            li.classList.add('page-item');
            li.innerHTML = `<a class="page-link" href="#">${i + 1}</a>`;
            li.addEventListener('click', function () {
                const start = i * rowsPerPage;
                const end = start + rowsPerPage;

                // Update current page number
                currentPageSpan.innerText = i + 1;

                // Hide all rows
                for (let j = 0; j < totalRows; j++) {
                    rows[j].style.display = 'none';
                }

                // Show the selected page of rows
                for (let j = start; j < end; j++) {
                    if (rows[j]) {
                        rows[j].style.display = '';
                    }
                }
            });
            pagination.appendChild(li);
        }
    }

    // Call paginateTable on page load
    document.addEventListener('DOMContentLoaded', paginateTable);
</script>

<script>
    function printFile(filePath) {
        // Function to handle printing logic
        window.open(filePath, '_blank').print();
    }
</script>

 					

 
    <!-- Javascript -->          
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Charts JS -->
    <script src="assets/plugins/chart.js/chart.min.js"></script> 
    <script src="assets/js/index-charts.js"></script> 
    
    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 

</body>
</html> 

