<h1><?php echo $titre ?></h1
<br>
<div class="row">
<div class="card-group">
<?php foreach ($last_articles as $last_article) : ?>
    <div class="col-sm-4">
<article>
    <div class="card mb-4">
        <?php if($last_article->getThumbnail()->getFilename()!= NULL) : ?>
            <img class="card-img-top" src="<?php echo \Lib\Application::$racine.'images/thumbnails/'.$last_article->getThumbnail()->getFilename(); ?>" alt="<?php  htmlspecialchars($last_article->getTitre());?>">
        <?php endif ?>
    </div>
        <div class="card-block">
            <h2 class="card-title"><?php echo $last_article->getTitre(); ?></h2>
            <p><?php echo $last_article->getExtrait(); ?></p>
            <a href="<?php echo \Lib\Application::$racine.'blog/'.$last_article->getSlug().'-'.$last_article->getId() ?>" class="btn btn-primary">En savoir +</a>
        </div>
        <div class="card-footer text-muted">
            Ajouté le <?php echo $last_article->getFrDate($last_article->getDate(), '%d/%m/%g'); ?>
        </div>
</article>
    </div>
<?php endforeach ?>
</div>
</div>
