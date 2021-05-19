<?php

namespace randbook\Blog\Model;

require_once("model/Manager.php");

/*
Fonction permettant d'afficher la page d'acceuil, de trier les livres (par série, titre, auteur, genre, appréciation, date d'ajout).
Fonction pour le choix aléatoire du livre à lire ensuite.
Fonction permettant d'afficher la page explicatif du livre.
Fonction permettant de modifier l'appréciation du livre.
*/
class SortManager extends Manager
{
	/*public function pagination($donnees)
	{
		$db = $this->dbConnect();
		// On recupère le nombre de livres pour connaitre le nombre de pages a proposer
        $req = $db->query('SELECT COUNT(*) AS nb_livre FROM book');
        $donnees = $req->fetch();
        $nb_livres = $donnees['nb_livre'];
		return $nb_livres;
	}*/
	
	public function look()
	{
		$db = $this->dbConnect();
		$donnees = $db->query('SELECT id, serie, title, id_title, author, genre, love, DATE_FORMAT(addDate, \'%d/%m/%Y\') AS post_date_fr FROM book');
		//$this->pagination($donnees);
		return $donnees;
	}
	
	public function sortbychoice($choix)
	{
			$db = $this->dbConnect();
			$donnees = $db->query('SELECT id, serie, title, id_title, author, genre, love, DATE_FORMAT(addDate, \'%d/%m/%Y\') AS post_date_fr FROM book ORDER BY '. $choix .' ASC');
			
			return $donnees;
	}
	
	public function aleatoire()
	{
		$db = $this->dbConnect();
		
		// On compte le nombre de lignes dans la base de données
		$donnees = $db->query('SELECT COUNT(id) AS nombresLignes FROM book');
		$data = $donnees->fetch();
		$max = $data['nombresLignes'];
		
		// Si la variable max est plus grande que 0 et qu'elle existe on lit les données dans la base de données
		$donnees = $db->query('SELECT id, serie, title, id_title, author, genre, love, DATE_FORMAT(addDate, \'%d/%m/%Y\') AS post_date_fr FROM book');
		if ($max != 0) {	
			$livre = mt_rand(1, $max); // Fonction pour généré le nombre aléatoire
			if ($livre <= $max) { 
				$donnees = $db->query('SELECT id, serie, title, id_title, author, genre, love, DATE_FORMAT(addDate, \'%d/%m/%Y\') AS date_format_fr FROM book WHERE id="'. $livre .'"');
			}
		}
		return $donnees;
	}
	
	public function book($id)
	{
		$db = $this->dbConnect();
		
		/*$donnees = $db->query('SELECT
			b.id id_livre, b.serie serie, b.title title, b.author author, b.genre genre, b.resume resume, b.love love, b.id_image id_img, DATE_FORMAT(b.addDate, \'%d/%m/%Y\') AS post_date_fr,
			i.id id_image, i.name name, i.file_url file_url
			FROM images i INNER JOIN book b ON b.id_image = i.id
			WHERE b.id = "'. $id .'"');*/
			
		$donnees = $db->query('SELECT id, serie, title, id_title, author, genre, _resume, love, _name, file_url, DATE_FORMAT(addDate, \'%d/%m/%Y\') AS post_date_fr, DATE_FORMAT(modify_date, \'%d/%m/%Y à %Hh%imin\') AS mod_date_fr FROM book WHERE id = "'. $id .'"');
		
		return $donnees;
	}
	
	public function appreciate($id, $love)
	{
		$db = $this->dbConnect();
		
		$donnees = $db->prepare('UPDATE book SET love = :newlove, modify_date = NOW() WHERE id = "'. $id .'"');
		$donnees->execute(array('newlove' => $love));
		
		$this->book($id);
	}
	
}