<?php

$smarty = require_once __DIR__ . '/../src/bootstrap.php';

use App\Models\Category;
use App\Models\Article;

$categoryId = $_GET['id'] ?? null;
if (!$categoryId) {
    header('Location: /');
    exit;
}

$categoryModel = new Category();
$articleModel = new Article();

$category = $categoryModel->find($categoryId);
if (!$category) {
    die("Категория не найдена");
}

$sort = $_GET['sort'] ?? 'created_at';
$page = (int)($_GET['page'] ?? 1);
$perPage = 5;
$offset = ($page - 1) * $perPage;

$articles = $articleModel->getByCategory($categoryId, $sort, 'DESC', $perPage, $offset);
$totalArticles = $articleModel->countByCategory($categoryId);
$totalPages = ceil($totalArticles / $perPage);

$smarty->assign('category', $category);
$smarty->assign('articles', $articles);
$smarty->assign('currentPage', $page);
$smarty->assign('totalPages', $totalPages);
$smarty->assign('currentSort', $sort);

$smarty->display('category.tpl');
