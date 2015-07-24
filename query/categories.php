<?php
    $Categories = "SELECT *
			FROM categories";

    $CategoriesReponse = $app['db']->fetchAll($Categories);