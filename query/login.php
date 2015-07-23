<?php
if (isset($data['login'])) {
	$Login = "SELECT * 
			FROM utilisateurs
			WHERE login = '".htmlspecialchars($data['login'])."'
			AND password = '".crypt(htmlspecialchars($data['password']), '$2y$08$'.__SALTCRYPT__.'$')."'";

    $LoginReponse = $app['db']->fetchAssoc($Login);
}