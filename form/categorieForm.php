<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Doctrine\DBAL\Connection;

$app->register(new FormServiceProvider());
$app->register(new TranslationServiceProvider());

$app->match('/ajouter/categorie', function (Request $request) use ($app) {

session_start();

include '../query/utilisateurs.php';
include '../query/articles.php';
include '../query/categories.php';

    $form = $app['form.factory']->createBuilder('form')
        ->add('nom', 'text', array('attr' => array('placeholder' => 'Nom de la catégorie')))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

            $app['db']->insert('categories', array(
                  'nom_categories' => $data['nom'],
                  'status' => '1'
                ));
            
          return $app->redirect('../accueil');

        }

if (isset($_SESSION['login'])) {
    $layout = $app['twig']->loadTemplate('layout.twig');
    return $app['twig']->render('addcategories.twig', array('form' => $form->createView(), 'layout' => $layout, 'users' => $_SESSION['login'], 'infousers' => $utilisateursReponse, 'nbnotifs' => $NbNotificationsReponse['nbNotifs'], 'notifications' => $NotificationsReponse, 'categories' => $CategoriesReponse));
}
else {
      return $app->redirect('../register');
}

});