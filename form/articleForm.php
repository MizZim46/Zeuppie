<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Doctrine\DBAL\Connection;

$app->register(new FormServiceProvider());
$app->register(new TranslationServiceProvider());

$app->match('/ajouter/articles', function (Request $request) use ($app) {

session_start();

include '../query/utilisateurs.php';
include '../query/articles.php';
include '../query/categories.php';

    $form = $app['form.factory']->createBuilder('form')
        ->add('titre', 'text', array('attr' => array('placeholder' => 'Titre de votre article')))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

            $app['db']->insert('articles', array(
                  'id_utilisateurs' => $utilisateursReponse['id_utilisateurs'],
                  'id_categories' => htmlspecialchars(addslashes($_POST['categories'])),
                  'titre' => htmlspecialchars(addslashes($data['titre'])),
                  'contenu' => htmlspecialchars(addslashes($_POST['contenu'])),
                  'status' => '1',
                  'date_articles' => date('Y-m-d H:i:s')
                ));
            
          return $app->redirect('../accueil');

        }

if (isset($_SESSION['login'])) {
    $layout = $app['twig']->loadTemplate('layout.twig');
    return $app['twig']->render('addarticles.twig', array('form' => $form->createView(), 'layout' => $layout, 'users' => $_SESSION['login'], 'infousers' => $utilisateursReponse, 'nbnotifs' => $NbNotificationsReponse['nbNotifs'], 'notifications' => $NotificationsReponse, 'categories' => $CategoriesReponse));
}
else {
      return $app->redirect('../register');
}

});