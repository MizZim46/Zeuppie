<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Doctrine\DBAL\Connection;

$app->register(new FormServiceProvider());
$app->register(new TranslationServiceProvider());

$app->match('/categories/{idcat}/articles/{idart}', function ($idcat, $idart, Request $request) use ($app) {

$idcat = str_replace("'", "", $idcat);
$idart = str_replace("'", "", $idart);


    if (empty($idcat) OR empty($idart)) {
        return $app->redirect('../../../accueil');
    }

session_start();

include '../query/utilisateurs.php';
include '../query/articles.php';
include '../query/categories.php';

if (isset($_SESSION['login'])) {

$layout = $app['twig']->loadTemplate('layout.twig');

    $form = $app['form.factory']->createBuilder('form')
        ->add('commentaire', 'textarea', array('attr' => array('placeholder' => 'Votre message')))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

            $app['db']->insert('commentaires', array(
                  'id_articles_commentaires' => htmlspecialchars(addslashes($idart)),
                  'id_utilisateurs_commentaires' => $utilisateursReponse['id_utilisateurs'],
                  'message_commentaires' => htmlspecialchars(addslashes($data['commentaire'])),
                  'date_commentaires' => date('Y-m-d H:i:s'),
                  'active_commentaires' => '1'
                ));
            
          return $app->redirect(htmlspecialchars(addslashes($idart)));
      }




    return $app['twig']->render('articlesView.twig', array('form' => $form->createView(), 'users' => $_SESSION['login'], 'commentaires' => $CommentairesReponse, 'infousers' => $utilisateursReponse, 'nbnotifs' => $NbNotificationsReponse['nbNotifs'], 'notifications' => $NotificationsReponse, 'articles' => $ArticlesReponse, 'categories' => $CategoriesReponse, 'categoriesbyid' => $CategoriesByIdReponse, 'layout' => $layout));
}
else {
  return $app->redirect('inscription');
}
});
