{extends file="layout.tpl"}

{block name=title}Главная - Мой Блог{/block}

{block name=content}
    <h1>Категории блога</h1>

    {foreach $categories as $category}
        <section class="category-block">
            <h2>{$category.name}</h2>
            <p>{$category.description}</p>
            
            <div class="articles-grid">
                {foreach $category.articles as $article}
                    <div class="article-card">
                        <img src="{$article.image}" alt="{$article.title}" style="width: 200px;">
                        <h3><a href="/article.php?id={$article.id}">{$article.title}</a></h3>
                        <p>{$article.description}</p>
                        <span>Дата: {$article.created_at}</span>
                    </div>
                {/foreach}
            </div>

            <a href="/category.php?id={$category.id}" class="btn">Все статьи категории {$category.name}</a>
            <hr>
        </section>
    {/foreach}
{/block}
