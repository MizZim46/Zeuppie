<?php
	$Inscription = "SELECT * 
			FROM utilisateurs
			WHERE login = '".htmlspecialchars($data['login'])."'";

    $InscriptionReponse = $app['db']->fetchAssoc($Inscription);