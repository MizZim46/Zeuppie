<?php
	$Utilisateurs = "SELECT * 
			FROM utilisateurs
			WHERE login = '".$_SESSION['login']."'";

    $utilisateursReponse = $app['db']->fetchAssoc($Utilisateurs);