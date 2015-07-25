<?php
$app->get('/categories/{idcat}/articles/{idart}', function ($idcat, $idart) use ($app) {

session_start();

include '../query/utilisateurs.php';
include '../query/articles.php';
include '../query/categories.php';

if (isset($_SESSION['login'])) {

$layout = $app['twig']->loadTemplate('layout.twig');

    return $app['twig']->render('articlesView.twig', array('users' => $_SESSION['login'], 'infousers' => $utilisateursReponse, 'nbnotifs' => $NbNotificationsReponse['nbNotifs'], 'notifications' => $NotificationsReponse, 'articles' => $ArticlesReponse, 'categories' => $CategoriesReponse, 'categoriesbyid' => $CategoriesByIdReponse, 'layout' => $layout));
}
else {
  return $app->redirect('inscription');
}
});
