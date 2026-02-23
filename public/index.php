<?php

$smarty = require_once __DIR__ . '/../src/bootstrap.php';

use App\Models\Category;
use App\Models\Article;

$categoryModel = new Category();
$articleModel = new Article();

$categories = $categoryModel->getAllWithArticles();

foreach ($categories as &$category) {
    $category['articles'] = $articleModel->getLatestByCategory($category['id'], 3);
}

$smarty->assign('categories', $categories);
$smarty->display('index.tpl');
