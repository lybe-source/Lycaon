<?php

namespace randbook\Blog\Model;

require_once("model/Manager.php");

/* Fonction de recherche de mot clés sur la page d'acceuil
Gros problèmes de fonctionnement pour le moment
*/
class SearchManager extends Manager
{
	public function search ($search)
	{
		if (isset($_GET['search'])) {
			htmlspecialchars($q = $_GET['search']);
	
			// Fonction qui explose la chaine et met chaque mot dans un tableau
			$s = explode(" ", $q);
			
			$db = $this->dbConnect();
			$sql = $db->query("SELECT * FROM book");
	
			// On parcourt le tableau
			$i = 0;
			foreach($s as $mot){
				if (strlen($mot) > 3) {
					if($i == 0) {
						// $sql. Permet d'accrémenter la chaine dans la requète
						$sql .= ' WHERE '; // Permet de rajouter WHERE à la requète sql
					} else {
						$sql .= ' OR '; // Permet de rajouter OR à la requète sql
					}
					$sql .= " title LIKE '% $mot %' OR serie LIKE '% $mot %'"; // Les espaces à % $mot % permettent d'avoir des résultats que sur les mots rechercher par exemple en cherchant MAL il ne pourrait pas nous sortir ANIMAL
					$i++;
				}
			}
			// Affiche le nombre de résultats trouvé dans la recherche
			echo mysql_num_rows($sql);
			if($sql > 1) {
				". résultats";
			} elseif ($sql = 1) {
				". resultat";
			} else {
				". Aucun résultat trouvé";
			}
	
			while($d = mysql_fetch_assoc($sql) {
				echo '<h1>'. $d['serie'] .'</h1>'; // Erreur de syntaxe sur cette ligne echo error
		
				// On stocke la variable title
				$c = $d['title'];
		
				// On reparcourt le tableau
				$i = 0;
				foreach($s as $mot) {
					if (strlen($mot) > 3) {
						$i++;
						if ($i > 4) {
							$i = 1;
						}
						$c = str_ireplace($mot, '<span class="surligne'. $i .'">'. $mot .'</span>', $c); // str_ireplace permet de faire un remplacement insensible à la case, cela veut dire que majuscule ou pas il remplacera la chaine de caractère.
					}
				}
				//echo "<p>{$d['serie' || 'title']}</p>";
			}
		} else {
			echo "Pas de recherche effectuer";
		}
	}
}