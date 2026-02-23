<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{block name=title}Мой Блог{/block}</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="/">Главная</a>
        </nav>
    </header>

    <main>
        {block name=content}{/block}
    </main>

    <footer>
        <p>&copy; 2026 Мой Блог на PHP + Smarty</p>
    </footer>
</body>
</html>
