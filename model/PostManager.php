<?php

namespace randbook\Blog\Model;

require_once("model/Manager.php");

/*
Fonction permettant le post d'un livres ayant comme données: Série, Titre, Auteur et une image de couverture
*/
class PostManager extends Manager
{	
	public function addLivre($serie, $title, $author, $genre, $_resume, $imageUpload)
	{
		/* Vérification de la série */
		if (preg_match("#^[a-zA-Z0-9-' ]{2,}#i", $_POST['serie'])) {
			/* Vérification du titre */
			if (preg_match("#^[a-zA-Z0-9-' ]{2,}#i", $_POST['title'])) {
				/* Vérification de l'auteur */
				if (preg_match("#^[a-zA-Z- ]{2,}#i", $_POST['author'])) {
					/* Vérification du résumé */
					if (preg_match("#^[a-zA-Z][-.?!()'\", ]?#i", $_POST['_resume'])) {
						/* Vérification de l'image */
						/*if (preg_match("#^[a-zA-Z0-9]{2,}[-.?!()\,& ]\.[jpg] | [JPG] | [jpeg] | [JPEG] | [png] | [PNG]$#", $_FILES['imageUpload']['_name'])) {*/
							// On rend inoffensif les codes html que l'utilisateur aurait écrit
							htmlspecialchars($_POST['serie']);
							htmlspecialchars($_POST['title']);
							htmlspecialchars($_POST['author']);
							htmlspecialchars($_POST['_resume']);
						
							// On met la première lettre en majuscule
							ucfirst($serie);
							ucfirst($title);
							ucfirst($author);
							ucfirst($_resume);
							
							//var_dump($imageUpload); die;

							// Fonction pour l'image
							$file_name = $_FILES['imageUpload']['name'];
							$file_extension = strrchr($file_name, ".");
		
							$file_tmp_name = $_FILES['imageUpload']['tmp_name'];
							$file_dest = 'files/'.$file_name;
		
							$extensions_autorisees = array('.jpeg', '.JPEG', '.jpg', '.JPG', '.png', '.PNG');
							
							if(in_array($file_extension, $extensions_autorisees)) {
							if(move_uploaded_file($file_tmp_name, $file_dest)) {
									// Connexion à la base de donnée
									$db = $this->dbConnect();
									
									// On vérifie si le titre existe déjà dans la base de données
									$req = $db->query('SELECT title FROM book WHERE title="'. $_POST['title'] .'"');
									$book = $req->fetch();
									$req->closeCursor();
									
									if (strtolower($_POST['title']) != strtolower($book['title'])) {
										// Création de l'id_title grace à la regex et du title récupérer par le champ title
										$regex = "/(['\s])/"; // Permet de récupérer le caractère ' et les espaces
										$replacement = "_";
										$id_title = preg_replace($regex, $replacement, $title);
										

										$comments = $db->prepare('INSERT INTO book (serie, title, id_title, author, genre, _resume, love, _name, file_url, addDate, modify_date) VALUES (?, ?, ?, ?, ?, ?, 1, ?, ?, NOW(), NOW())');
										$affectedLines = $comments->execute(array($serie, $title, $id_title, $author, $genre, $_resume, $file_name, $file_dest));
	
										echo '<script type="text/javascript">window.alert("Le livre est ajouté à la base de donnée et l\'image envoyé avec succès");</script>';
									} else {
										echo '<script type="text/javascript">window.alert("Le livre existe déjà dans la base de donnée");</script>';
									}
							} else {
								echo '<script type="text/javascript">window.alert("Une erreur est survenue lors de l\'envoie du fichier");</script>';
							}
							} else {
								echo '<script type="text/javascript">window.alert("Seuls les fichiers ayant les extensions jpeg, jpg et png sont autorisés");</script>';
							}
							return $affectedLines;
							
						/*} else {
							echo '<script type="text/javascript">window.alert("Erreur: Image invalide");</script>';
						}*/
					} else {
						echo '<script type="text/javascript">window.alert("Erreur: Résumé invalide<br />Caractères autorisés: Lettre, caractères spéciaux");</script>';
					}
				} else {
					echo '<script type="text/javascript">window.alert("Erreur: Nom d\'auteur invalide<br />Caractères autorisés: Lettres, - et espace");</script>';
				}
			} else {
				echo '<script type="text/javascript">window.alert("Erreur: Titre invalide<br />Caractères autorisés: Lettres, - et espace");</script>';
			}
		} else {
			echo '<script type="text/javascript">window.alert("Erreur: Série invalide<br />Caractères autorisés: Lettres, - et espace");</script>';
		}
	}
}