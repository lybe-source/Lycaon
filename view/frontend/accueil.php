<?php $title = 'Random Book'; ?>
<?php ob_start(); ?>

<div class="container">
	<section>
		<article>
			<h1>Trier les livres</h1>
			<form method="post" action="index.php?action=sortby">
			<p>
				<label for="serieAccueil" id="triSerie">Série</label>
					<input type="radio" name="choix" value="serie" class="tri" id="serieAccueil" />
				<label for="titleAccueil" id="triTitle">Titre</label>
					<input type="radio" name="choix" value="title" class="tri" id="titleAccueil" />
				<label for="authorAccueil" id="triAuteur">Auteur</label>
					<input type="radio" name="choix" value="author" class="tri" id="authorAccueil" /><br />
				<label for="genreAccueil" id="triGenre">Genre</label>
					<input type="radio" name="choix" value="genre" class="tri" id="genreAccueil" />
				<label for="loveAccueil" id="triLove">Appréciation</label>
					<input type="radio" name="choix" value="love" class="tri" id="loveAccueil" />
				<label for="addDateAccueil" id="triAddDate">Date d'ajout</label>
					<input type="radio" name="choix" value="addDate" class="tri" id="addDateAccueil" /><br />
			</p>
			<p>
				<input type="submit" value="Valider" class="tri2" /><input type="reset" value="Réinitialiser" class="tri2" /><br />
			</p>
			
			</form>
			<form method="POST" action="index.php?action=lookBook&amp;search=">
				<label for="search" class="search"><input type="text" name="search" placeholder="Champ recherche" /></label>
					<input type="submit" value="Chercher" id="search"/>
			</form>
		</article>
	</section>

	<section>
		<article>
			<h1>Liste des livres</h1>

			<table><thead><tr><th>Série</th><th>Titre</th><th>Auteur</th><th>Genre</th><th>Appréciation</th><th>Date d'ajout</th></tr></thead>
			<?php
			// Si on a plus de 20 livres, on propose différents liens : Page <a>1</a> <a>2</a> <a>3</a> ...
			/*if ($nb_livres > 20)
			{
				// On calcul le nombre de page nécessaires, puis on les affiche à l'aide d'une boucle
				$nb_pages = $nb_livres / 10 + 1; // 19 messages => 19 / 10 + 1 = 2.9
				?>
					<div id="pages">
						<p>Afficher des messages plus anciens ?</p>
						<p>Page : <?php for ($i = 1; $i < $nb_pages; $i++)
						{
							echo '<a href="index.php?action=lookBook&amp;page=' . $i . '">' . $i . '</a> / ';
						}
					?>
					</p>
				</div>
            <?php
			}*/
			// On verifie que la variable GET 'page' existe et que c'est bien un nombre différent de zéro
			/*if (isset($_GET['page']) AND is_numeric($_GET['page']) AND $_GET['page'] != 0) {
				$limite = $_GET['page'] - 1;*/
			
				while ($donnees = $livres->fetch()) {
					echo '<tr id="'. $donnees['id_title'] .'"><td>'
					. $donnees['serie'] .
					'</td><td><a href="index.php?action=showbook&amp;id='. $donnees['id']. '" class="link">'
					. $donnees['title'] .
					'</a></td><td>'
					. $donnees['author'] .
					'</td><td>'
					. $donnees['genre'] .
					'</td><td>'
					. $donnees['love'] .
					'</td><td>'
					. $donnees['post_date_fr'] .
					'</td></tr>';
				}
				echo '</tbody></table>';
			/*} else {
				while ($donnees = $livres->fetch())
				{
					echo '<tr><td>'
					. $donnees['serie'] .
					'</td><td><a href="index.php?action=showbook&amp;id='. $donnees['id']. '" class="link">'
					. $donnees['title'] .
					'</a></td><td>'
					. $donnees['author'] .
					'</td><td>'
					. $donnees['genre'] .
					'</td><td>'
					. $donnees['love'] .
					'</td><td>'
					. $donnees['post_date_fr'] .
					'</td></tr>';
				}
				echo '</tbody></table>';
			}*/
			?>
		</article>
	</section>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>