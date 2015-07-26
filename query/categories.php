<?php
    $Categories = "SELECT *
			FROM categories";

    $CategoriesReponse = $app['db']->fetchAll($Categories);

    if (!empty($idcat)) {

    $CategoriesById = "SELECT *
			FROM categories
			WHERE id_categories = ".htmlspecialchars(addslashes($idcat));

    $CategoriesByIdReponse = $app['db']->fetchAssoc($CategoriesById);

    }