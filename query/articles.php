<?php
    $Articles = "SELECT *
			FROM articles AS a
			LEFT JOIN utilisateurs AS u 
			ON a.id_utilisateurs = u.id_utilisateurs
			LEFT JOIN categories AS c
			ON a.id_categories = c.id_categories
			WHERE a.status = 1";

    $ArticlesReponse = $app['db']->fetchAll($Articles);