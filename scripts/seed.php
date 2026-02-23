<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Database;

$db = Database::getInstance()->getConnection();

$db->exec("SET FOREIGN_KEY_CHECKS = 0");
$db->exec("TRUNCATE TABLE article_categories");
$db->exec("TRUNCATE TABLE articles");
$db->exec("TRUNCATE TABLE categories");
$db->exec("SET FOREIGN_KEY_CHECKS = 1");

$categories = [
    ['Технологии', 'Все о гаджетах и софте'],
    ['Путешествия', 'Мир вокруг нас'],
    ['Кулинария', 'Рецепты и еда'],
    ['Спорт', 'Здоровый образ жизни'],
];

foreach ($categories as $cat) {
    $stmt = $db->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
    $stmt->execute($cat);
}

$categoryIds = $db->query("SELECT id FROM categories")->fetchAll(PDO::FETCH_COLUMN);

for ($i = 1; $i <= 20; $i++) {
    $stmt = $db->prepare("INSERT INTO articles (title, description, content, image, views, created_at) VALUES (?, ?, ?, ?, ?, ?)");
    
    $date = date('Y-m-d H:i:s', strtotime("-$i days"));
    $stmt->execute([
        "Статья №$i",
        "Краткое описание для статьи номер $i. Это интересный пост.",
        "Полный текст статьи номер $i. Здесь много полезной информации о чем-то важном.",
        "https://picsum.photos/seed/post$i/800/400",
        rand(0, 1000),
        $date
    ]);
    
    $articleId = $db->lastInsertId();
    $randomCats = array_rand(array_flip($categoryIds), rand(1, 2));
    if (!is_array($randomCats)) $randomCats = [$randomCats];
    
    foreach ($randomCats as $catId) {
        $db->prepare("INSERT INTO article_categories (article_id, category_id) VALUES (?, ?)")
           ->execute([$articleId, $catId]);
    }
}

echo "Seeding completed successfully.\n";
