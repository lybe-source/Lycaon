<?php
	session_start();
?>

<?php $title = 'Random Book'; ?>
<?php ob_start(); ?>

<div class="container">
	<section>
		<article id="add">
			<h1>Ajouter les livres</h1>
			
			<form method="POST" enctype="multipart/form-data" action="index.php?action=addBook">
				<p>
					<label for="serie" class="serieLabel">Série :</label>
						<input type="text" name="serie" id="serie" rows="10" cols="65" maxlength="255" placeholder="Série complète" required /><br />
					<label for="title" class="titleLabel">Titre :</label>
						<input type="text" name="title" id="title" rows="10" cols="65" maxlength="255" placeholder="Titre complet" required /><br />
					<label for="author" class="authorLabel">Auteur :</label>
						<input type="text" name="author" id="author" rows="10" cols="65" maxlength="255" placeholder="Auteur du livre" required /><br />
				</p>
				<p>
					<label for="manga" class="MangaLabel">Manga</label>
						<input type="radio" name="genre" id="manga" value="Manga" />
					<label for="fantastique" class="FantastiqueLabel">Fantastique</label>
						<input type="radio" name="genre" id="fantastique" value="Fantastique" /><br />
					<label for="policier" class="PolicierLabel">Policier</label>
						<input type="radio" name="genre" id="policier" value="Policier" />
					<label for="romance" class="RomanceLabel">Romance</label>
						<input type="radio" name="genre" id="romance" value="Romance" /><br />
					<!--<label for="genre" class="genreLabel">Genre :</label>
						<input type="radio" name="genre" id="genre" value="" />
					<label for="genre" class="genreLabel">Genre :</label>
						<input type="radio" name="genre" id="genre" value="" /><br />-->
					
				</p>
				<p>
					<label for="_resume" class="resumeLabel">Résumé :</label><br />
						<textarea name="_resume" id="_resume" rows="10" cols="65" placeholder="Résumé en quelques lignes" required ></textarea><br />
				</p>
				
				<p>
					<label for="imageUpload" class="imageLabel">Couverture :</label>
						<input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
						<input type="file" name="imageUpload" id="imageUpload" />
				</p>
			
			<p>
				<input type="submit" value="Enregistrer" class="add" />
				<input type="reset" value="reset" class="add" />
			</p>
			</form>
		</article>
	</section>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>