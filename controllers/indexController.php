<?php
$app->get('/accueil', function () use ($app) {

session_start();

include '../query/utilisateurs.php';
include '../query/articles.php';
include '../query/categories.php';

if (isset($_SESSION['login'])) {

$layout = $app['twig']->loadTemplate('layout.twig');

    return $app['twig']->render('index.twig', array('users' => $_SESSION['login'], 'infousers' => $utilisateursReponse, 'nbnotifs' => $NbNotificationsReponse['nbNotifs'], 'notifications' => $NotificationsReponse, 'articles' => $ArticlesReponse, 'categories' => $CategoriesReponse, 'layout' => $layout));
}
else {
	return $app->redirect('inscription');
}
});
