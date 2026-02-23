{extends file="layout.tpl"}

{block name=title}{$category.name} - Мой Блог{/block}

{block name=content}
    <h1>{$category.name}</h1>
    <p>{$category.description}</p>

    <div class="sorting">
        Сортировать по:
        <a href="?id={$category.id}&sort=created_at&page={$currentPage}">Дате</a> | 
        <a href="?id={$category.id}&sort=views&page={$currentPage}">Просмотрам</a>
    </div>

    <div class="articles-list">
        {foreach $articles as $article}
            <div class="article-item">
                <img src="{$article.image}" alt="{$article.title}" style="width: 150px;">
                <div class="info">
                    <h3><a href="/article.php?id={$article.id}">{$article.title}</a></h3>
                    <p>{$article.description}</p>
                    <small>Просмотров: {$article.views} | Дата: {$article.created_at}</small>
                </div>
            </div>
        {/foreach}
    </div>

    <div class="pagination">
        {for $p=1 to $totalPages}
            <a href="?id={$category.id}&sort={$currentSort}&page={$p}" {if $p == $currentPage}class="active"{/if}>{$p}</a>
        {/for}
    </div>
{/block}
