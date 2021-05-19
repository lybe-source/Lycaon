<?php $title = 'Random Book'; ?>
<?php ob_start(); ?>

<div class="container">
	<section>
		<article class="book">
			<?php
				while($donnees = $livres->fetch()) {
					echo '<h1>' . $donnees['serie'] . '</h1><br /><h2>'
					. $donnees['title'] . '</h2> de l\'auteur <h2>' . $donnees['author'] . ',</h2><br /><p>'
					. $donnees['_resume'] . '</p><p>dont l\'appréciation que vous avez est de ' . $donnees['love'] . '/5</p>' . '<p>Livre ajouté le ' . $donnees['post_date_fr'] . '</p>'; 
					if($donnees['mod_date_fr'] != NULL){
						echo '<p>Modifié le ' . $donnees['mod_date_fr'] .'</p>';
					}
					
				
			?>
			<form method="POST" action="index.php?action=update_love&id=<?= $donnees['id'] ?>">
				<p>
					<label for="love" class="loveLabel">Appréciation :</label>
						<input type="radio" name="love" value="1" id="love" />
						<input type="radio" name="love" value="2" id="love" />
						<input type="radio" name="love" value="3" id="love" />
						<input type="radio" name="love" value="4" id="love" />
						<input type="radio" name="love" value="5" id="love" /><br />					
				</p>
				<p>
					<input type="submit" value="Enregistrer" class="enregistrer_love" />
					<input type="reset" value="reset" class="enregistrer_love" />
				</p>
			</form>
		</article>
		<aside class="asideImage">
			<?php
					echo '<p><img src="'. $donnees['file_url'] .'" alt="'. $donnees['_name'] .'" class="image" /></p>';
				}
			?>
		</aside>
	</section>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>