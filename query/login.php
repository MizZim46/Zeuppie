<?php
if (isset($data['login'])) {
	$Login = "SELECT * 
			FROM utilisateurs
			WHERE email = '".$data['login']."'
			AND password = '".md5($data['password'])."'";

    $LoginReponse = $app['db']->fetchAssoc($Login);
}