<?php
	require('controler/frontend.php');
	/*
	Router du site, cela permet d'envoyer les données au fonctions qui les traites dans le controler
	*/
	try {
		if (isset($_GET['action'])) {
			if ($_GET['action'] == 'lookBook') {
				lookbook();
			} elseif ($_GET['action'] == 'sortby') { 
				if (isset($_POST['choix'])) {
					trier($_POST['choix']);
				} else {
					echo 'Erreur: Aucun choix prédéfini';
				}
			} elseif ($_GET['action'] == 'ajouter') {
				require('view/frontend/add.php');
			} elseif ($_GET['action'] == 'random') {
				random();
			} elseif ($_GET['action'] == 'addBook') {
				if (!empty($_POST['serie'])) {
					if (!empty($_POST['title'])) {
						if (!empty($_POST['author'])) {
							if (!empty($_POST['_resume'])) {
								/*if ($id_image = null) { $id_image = 0;*/
									addBook($_POST['serie'], $_POST['title'], $_POST['author'], $_POST['genre'], $_POST['_resume'], $_FILES['imageUpload']); /*Si une action addBook qu'une id est envoyé et plus grand que 0 et que le titre, l'auteur et le résumé n'est pas vide */
								/*}*/
							} else {
								echo 'Erreur: Aucun résumé';
							}
						} else {
							echo 'Erreur: Aucun auteur';
						}
					} else {
						echo 'Erreur: Aucun titre';
					}
				} else {
					echo 'Erreur: Aucune série';
				}
			} elseif ($_GET['action'] == 'search') {
				if (!empty($_GET['search'])) {
					//chercher($_GET['search']);
				} else {
					echo 'Erreur: Aucune recherche';
				}
			} elseif ($_GET['action'] == 'showbook') {
				if (isset($_GET['id']) && $_GET['id'] > 0) {
					showbook($_GET['id']);
				} else {
					echo 'Erreur: Aucune id envoyer';
				}
			} elseif ($_GET['action'] == 'update_love') {
				if (isset($_GET['id']) && $_GET['id'] > 0) {
					update_love($_GET['id'], $_POST['love']);
				} else {
					echo 'Erreur: Aucune id enveoyer';
				}
			}
		} /*elseif (isset($_GET['search'])){

		}*/ else {
			//require('view/frontend/accueil.php');
			header('Location: index.php?action=lookBook');
		}
	}
	
	catch(Exception $e) {
	// Pour afficher une erreur d'une autre façon faire ça
	//errorMessage = $e->getMessage();
	//require('view/errorView.php');
    echo 'Erreur : ' . $e->getMessage();
	}