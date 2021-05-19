<?php $title = 'Random Book'; ?>
<?php ob_start(); ?>

<div class="container">
	<!--<section>
		<article>
			<h1>Trier les livres</h1>
			<form method="post" action="index.php?action=random">
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
				<input type="submit" value="Lancer" class="tri2" /><input type="reset" value="Réinitialiser" class="tri2" /><br />
			</p>
			</form>
		</article>
	</section>-->

	<section>
		<article>
			<h1>Choix du livre</h1>
			
			<?php
			while($donnees = $livres->fetch()) {
				echo '<p><span class="date">Ajouté le ' . $donnees['date_format_fr'] . '</span><br />Le livre choisi aléatoirement est de la série ' . $donnees['serie'] . ' dont le titre est <a href="index.php?action=showbook&amp;id='. $donnees['id']. '" class="link">' . $donnees['title'] . '</a></p>';
			}
			?>
		</article>
	</section>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>