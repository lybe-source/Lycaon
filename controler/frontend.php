<?php
require_once('model/SortManager.php');
require_once('model/PostManager.php');
//require_once('model/SearchManager.php');

/*
Controler, fonction permettant l'affichage des pages et appel aux fonctions de traitement des données
*/
function lookbook()
{
	$connect = new randbook\Blog\Model\SortManager();
	$livres = $connect->look();
	
	require('view/frontend/accueil.php');
}
/*
function paginer()
{
	$connect = new randbook\Blog\Model\SortManager();
	$livres = $connect->pagination();
	
	require('view/frontend/accueil.php');
}
*/
function trier($choix)
{
	$connect = new randbook\Blog\Model\SortManager();
	$livres = $connect->sortbychoice($choix);
	
	require('view/frontend/accueil.php');
}

function random()
{
	$connect = new randbook\Blog\Model\SortManager();
	$livres = $connect->aleatoire();
	
	require('view/frontend/random.php');
}

function addBook($serie, $title, $author, $genre, $_resume, $imageUpload)
{
	$connect = new randbook\Blog\Model\PostManager();
	$affectedLines = $connect->addLivre($serie, $title, $author, $genre, $_resume, $imageUpload);
	
	if ($affectedLines === false) {
		die ('Impossible d\'ajouter le livre !');
	} else {
		header('Location: index.php?action=ajouter');
	}
}

function chercher($search)
{
	$connect = new randbook\Blog\Model\SearchManager();
	
	$livres = $connect->search($search);
	
	if ($livres === false) {
		die ('Impossible de faire la recherche');
	} else {
		header('Location: index.php?action=lookBook');
	}
}

function showbook($id)
{
	$connect = new randbook\Blog\Model\SortManager();
	$livres = $connect->book($id);
	
	require('view/frontend/showbook.php');
}

function update_love($id, $love)
{
	$connect = new randbook\Blog\Model\SortManager();
	$livres = $connect->appreciate($id, $love);
	
	if ($livres === false) {
		die ('Impossible de faire la recherche');
	} else {
		header('Location: index.php?action=showbook&id='.$id.'');
	}
}
