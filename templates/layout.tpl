<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{block name=title}Мой Блог{/block}</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <a href="/">Blogy<span>.</span></a>
            </div>
        </div>
    </header>

    <main class="container">
        {block name=content}{/block}
    </main>

    <footer class="main-footer">
        <div class="container">
            <p>Copyright &copy;2026. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
