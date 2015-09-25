<?php
    $Articles = "SELECT *, COUNT(id_commentaires) AS nbCommentaires
			FROM articles AS a
			LEFT JOIN utilisateurs AS u 
			ON a.id_utilisateurs = u.id_utilisateurs
			LEFT JOIN categories AS c
			ON a.id_categories = c.id_categories
			LEFT JOIN commentaires AS co 
			ON a.id_articles = co.id_articles_commentaires
			WHERE a.status = 1
			GROUP BY a.id_articles";

    $ArticlesReponse = $app['db']->fetchAll($Articles);


if (!empty($idcat)) {

        $ArticlesByCat = "SELECT *, COUNT(id_commentaires) AS nbCommentaires
			FROM articles AS a
			LEFT JOIN utilisateurs AS u 
			ON a.id_utilisateurs = u.id_utilisateurs
			LEFT JOIN categories AS c
			ON a.id_categories = c.id_categories
			LEFT JOIN commentaires AS co 
			ON a.id_articles = co.id_articles_commentaires
			WHERE a.status = 1
			AND a.id_categories = ".htmlspecialchars(addslashes($idcat))."
			GROUP BY a.id_articles";

    $ArticlesByCatReponse = $app['db']->fetchAll($ArticlesByCat);

}

if (!empty($idart)) {

        $Articles = "SELECT *, COUNT(id_commentaires) AS nbCommentaires
			FROM articles AS a
			LEFT JOIN utilisateurs AS u 
			ON a.id_utilisateurs = u.id_utilisateurs
			LEFT JOIN categories AS c
			ON a.id_categories = c.id_categories
			LEFT JOIN commentaires AS co 
			ON a.id_articles = co.id_articles_commentaires
			WHERE a.status = 1
			AND a.id_articles = ".htmlspecialchars(addslashes($idart))."
			GROUP BY a.id_articles";

    $ArticlesReponse = $app['db']->fetchAssoc($Articles);

        $Commentaires = "SELECT *
			FROM commentaires AS c
			INNER JOIN utilisateurs AS u 
			ON c.id_utilisateurs_commentaires = u.id_utilisateurs
			WHERE c.active_commentaires = 1
			AND c.id_articles_commentaires = ".htmlspecialchars(addslashes($idart));

    $CommentairesReponse = $app['db']->fetchAll($Commentaires);
}


if (!empty($idProfil)) {
    $Articles = "SELECT *
			FROM articles AS a
			LEFT JOIN utilisateurs AS u 
			ON a.id_utilisateurs = u.id_utilisateurs
			LEFT JOIN categories AS c
			ON a.id_categories = c.id_categories
			WHERE a.status = 1
			AND u.id_utilisateurs = ".$idProfil;

    $ArticlesActivityReponse = $app['db']->fetchAll($Articles);
}
else {
    $Articles = "SELECT *
			FROM articles AS a
			LEFT JOIN utilisateurs AS u 
			ON a.id_utilisateurs = u.id_utilisateurs
			LEFT JOIN categories AS c
			ON a.id_categories = c.id_categories
			WHERE a.status = 1
			AND u.id_utilisateurs = ".$utilisateursReponse['id_utilisateurs'];

    $ArticlesActivityReponse = $app['db']->fetchAll($Articles);
}