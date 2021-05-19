<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
		<meta name="author" content="Lybe_" />
        <title><?= $title ?></title>
		<link rel="stylesheet" href="public/css/style.css" />
		<link rel="stylesheet" href="public/css/nav.css" />
		<link rel="stylesheet" href="public/css/table.css" />
		<link rel="stylesheet" href="public/css/form.css" />
		<link rel="stylesheet" href="public/css/search.css" />
    </head>
        
    <body>
		<?php include("nav.php"); ?>
		<?php include("header.php"); ?>
        <?= $content ?>
		<?php include("footer.php"); ?>
    </body>
</html>