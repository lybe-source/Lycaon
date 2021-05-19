<?php

namespace randbook\Blog\Model;
/*
Fonction de connexion à la base de données MySQL
*/
class Manager
{
	protected function dbConnect()
	{
		$db = new \PDO('mysql:host=localhost;dbname=kath;charset=utf8', 'root', '');
		return $db;
	}
}