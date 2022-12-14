<h2><?= esc($title) ?></h2>

<?php if(session()->getFlashdata('doUpdateSuccess')) : ?>
    <h4><?= session()->getFlashdata('doUpdateSuccess'); ?></h4>
<?php endif; ?>

<?php if(! empty($news) && is_array($news)): ?>
    <?php foreach ($news as $newsItem): ?>

        <h3><?= esc($newsItem['title']) ?></h3>
        <div class="main">
            <?= esc($newsItem['body']) ?>
        </div>
        <p><a href="/news/<?= esc($newsItem['slug'], 'url')?>">View Article</a></p>
        <form action="/news/<?= esc($newsItem['id']) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit">Delete</button>
        </form>

        <p><a href="/news/edit/<?= esc($newsItem['id'], 'url')?>">Edit Article</a></p>

    <?php endforeach ?> 

    <?php else: ?>
        <h3>No News</h3>
        <p>Unable to find any news for you.</p>
        
<?php endif ?>