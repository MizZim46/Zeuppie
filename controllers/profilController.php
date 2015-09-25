<?php
$app->get('/profil', function () use ($app) {

session_start();

include '../query/utilisateurs.php';
include '../query/articles.php';
include '../query/categories.php';

if (isset($_SESSION['login'])) {

$layout = $app['twig']->loadTemplate('layout.twig');

    return $app['twig']->render('profil.twig', array('users' => $_SESSION['login'], 'infousers' => $utilisateursReponse, 'nbnotifs' => $NbNotificationsReponse['nbNotifs'], 'notifications' => $NotificationsReponse, 'articles' => $ArticlesReponse, 'categories' => $CategoriesReponse, 'layout' => $layout));
}
else {
	return $app->redirect('inscription');
	exit();
}
});



$app->get('/profil/{idProfil}', function ($idProfil) use ($app) {

$idProfil = str_replace("'", "", $idProfil);


    if (empty($idProfil)) {
        return $app->redirect('../accueil');
    }
session_start();

include '../query/utilisateurs.php';
include '../query/articles.php';
include '../query/categories.php';


	if (isset($_SESSION['login'])) {

	$layout = $app['twig']->loadTemplate('layout.twig');

	if ($utilisateursReponse) {
		$NoProfil = true;
	}
	else {
		$NoProfil = false;
	}

	    return $app['twig']->render('profil.twig', array('users' => $_SESSION['login'], 'infousers' => $utilisateursReponse, 'nbnotifs' => $NbNotificationsReponse['nbNotifs'], 'notifications' => $NotificationsReponse, 'articles' => $ArticlesReponse, 'categories' => $CategoriesReponse, 'NoProfil' => $NoProfil, 'layout' => $layout));
	}
	else {
		return $app->redirect('inscription');
		exit();
	}

});