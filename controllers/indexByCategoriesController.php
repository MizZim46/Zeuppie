<?php
$app->get('/categories/{idcat}', function ($idcat) use ($app) {

$idcat = str_replace("'", "", $idcat);


    if (empty($idcat)) {
        return $app->redirect('../accueil');
    }

session_start();

include '../query/utilisateurs.php';
include '../query/articles.php';
include '../query/categories.php';

if (isset($_SESSION['login'])) {

$layout = $app['twig']->loadTemplate('layout.twig');

    return $app['twig']->render('indexbycategories.twig', array('users' => $_SESSION['login'], 'infousers' => $utilisateursReponse, 'nbnotifs' => $NbNotificationsReponse['nbNotifs'], 'notifications' => $NotificationsReponse, 'articles' => $ArticlesByCatReponse, 'categories' => $CategoriesReponse, 'categoriesbyid' => $CategoriesByIdReponse, 'layout' => $layout));
}
else {
  return $app->redirect('inscription');
}
});
