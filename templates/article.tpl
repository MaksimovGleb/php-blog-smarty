{extends file="layout.tpl"}

{block name=title}{$article.title} - Мой Блог{/block}

{block name=content}
    <article class="full-article">
        <h1>{$article.title}</h1>
        
        <div class="meta">
            Категории: 
            {foreach $articleCategories as $cat}
                <a href="/category.php?id={$cat.id}">{$cat.name}</a>{if !$cat@last}, {/if}
            {/foreach}
            | Просмотров: {$article.views} | Дата: {$article.created_at}
        </div>

        {if $article.image}
            <img src="{$article.image}" alt="{$article.title}" style="max-width: 100%; height: auto;">
        {/if}

        <div class="description" style="font-style: italic; margin: 20px 0;">
            {$article.description}
        </div>

        <div class="content">
            {$article.content|nl2br}
        </div>
    </article>

    <section class="related-articles">
        <h2>Похожие статьи</h2>
        <div class="articles-grid">
            {foreach $relatedArticles as $rel}
                <div class="article-card">
                    <img src="{$rel.image}" alt="{$rel.title}" style="width: 150px;">
                    <h3><a href="/article.php?id={$rel.id}">{$rel.title}</a></h3>
                </div>
            {/foreach}
            {if empty($relatedArticles)}
                <p>Нет похожих статей.</p>
            {/if}
        </div>
    </section>
{/block}
