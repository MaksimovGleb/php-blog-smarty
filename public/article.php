<?php

$smarty = require_once __DIR__ . '/../src/bootstrap.php';

use App\Models\Article;

$articleId = $_GET['id'] ?? null;
if (!$articleId) {
    header('Location: /');
    exit;
}

$articleModel = new Article();

$article = $articleModel->find($articleId);
if (!$article) {
    die("Статья не найдена");
}

$articleModel->incrementViews($articleId);
$articleCategories = $articleModel->getCategories($articleId);
$relatedArticles = $articleModel->getRelated($articleId, 3);

$smarty->assign('article', $article);
$smarty->assign('articleCategories', $articleCategories);
$smarty->assign('relatedArticles', $relatedArticles);

$smarty->display('article.tpl');
