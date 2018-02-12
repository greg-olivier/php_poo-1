<a class="btn btn-primary" href="<?php echo \Lib\Application::$racine ?>admin/add">Ajouter un article</a>
<br>
<br>
<h2>Vous avez <?php echo $nb_items_nopub; ?> article(s) non  publié(s)</h2>
<br>
<div class="card-columns">
<?php foreach ($all_articles_nopub as $all_article_nopub) : ?>
    <a href="<?php echo \Lib\Application::$racine ?>admin/detail/<?php echo $all_article_nopub->getSlug() ?>">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $all_article_nopub->getTitre(); ?></h2>
                   <p><?php echo $all_article_nopub->getExtrait(); ?></p>
                </div>
            </div>
    </a>
<?php endforeach ?>
</div>
<br>
<br>
<h2>Vous avez <?php echo $nb_items_pub; ?> article(s) publié(s)</h2>
<hr>
<div class="card-columns">
    <?php foreach ($all_articles_pub as $all_article_pub) : ?>
        <a href="<?php echo \Lib\Application::$racine ?>admin/detail/<?php echo $all_article_pub->getSlug() ?>">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $all_article_pub->getTitre(); ?></h2>
                    <p><?php echo $all_article_pub->getExtrait(); ?></p>
                </div>
            </div>
        </a>
    <?php endforeach ?>
</div>
