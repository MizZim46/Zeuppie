<?php
    $Articles = "SELECT *
			FROM articles AS a
			LEFT JOIN utilisateurs AS u 
			ON a.id_utilisateurs = u.id_utilisateurs
			LEFT JOIN categories AS c
			ON a.id_categories = c.id_categories
			WHERE a.status = 1";

    $ArticlesReponse = $app['db']->fetchAll($Articles);

if (!empty($idcat)) {

        $ArticlesByCat = "SELECT *
			FROM articles AS a
			LEFT JOIN utilisateurs AS u 
			ON a.id_utilisateurs = u.id_utilisateurs
			LEFT JOIN categories AS c
			ON a.id_categories = c.id_categories
			WHERE a.status = 1
			AND a.id_categories = ".htmlspecialchars(addslashes($idcat));

    $ArticlesByCatReponse = $app['db']->fetchAll($ArticlesByCat);

}

if (!empty($idart)) {

        $Articles = "SELECT *
			FROM articles AS a
			LEFT JOIN utilisateurs AS u 
			ON a.id_utilisateurs = u.id_utilisateurs
			LEFT JOIN categories AS c
			ON a.id_categories = c.id_categories
			WHERE a.status = 1
			AND a.id_articles = ".htmlspecialchars(addslashes($idart));

    $ArticlesReponse = $app['db']->fetchAssoc($Articles);

}