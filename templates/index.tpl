{extends file="layout.tpl"}

{block name=title}Главная - Мой Блог{/block}

{block name=content}
    {foreach $categories as $category}
        <section class="category-section">
            <div class="category-header">
                <h2 class="category-title">{$category.name|upper}</h2>
                <a href="/category.php?id={$category.id}" class="view-all">View All</a>
            </div>
            
            <div class="articles-grid">
                {foreach $category.articles as $article}
                    <article class="article-card">
                        <div class="article-image">
                            <a href="/article.php?id={$article.id}">
                                <img src="{$article.image}" alt="{$article.title}">
                            </a>
                        </div>
                        <div class="article-body">
                            <h3 class="article-title">
                                <a href="/article.php?id={$article.id}">{$article.title}</a>
                            </h3>
                            <div class="article-date">{$article.created_at|date_format:"%B %e, %Y"}</div>
                            <p class="article-excerpt">{$article.description}</p>
                            <a href="/article.php?id={$article.id}" class="continue-reading">Continue Reading</a>
                        </div>
                    </article>
                {/foreach}
            </div>
        </section>
    {/foreach}
{/block}
