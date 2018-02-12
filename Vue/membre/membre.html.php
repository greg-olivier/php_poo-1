
<div class="container-fluid">
    <br>
    <h1>Bonjour <?php echo $_SESSION['auteur']->getNom()?></h1>
</div>
<br>
<br>
<h4>Restez informé et consultez nos derniers articles</h4>
<hr>
<div class="row">
<div class="card-deck">
    <?php foreach ($last_articles as $last_article) : ?>
    <div class="col-sm-4">
        <article>
            <div class="card">
                <?php if($last_article->getThumbnail()->getFilename() != NULL) : ?>
                    <img class="card-img-top" src="<?php echo \Lib\Application::$racine ?>images/thumbnails/<?php echo $last_article->getThumbnail()->getFilename() ?>" alt="<?php  htmlspecialchars($last_article->getTitre());?>">
                <?php endif ?>
            </div>
            <div class="card-block">
                <h2 class="card-title"><?php echo $last_article->getTitre(); ?></h2>
                <p><?php echo $last_article->getExtrait(); ?></p>
                <a href="<?php echo \Lib\Application::$racine?>blog/detail/<?php echo $last_article->getSlug() ?>" class="btn btn-primary">En savoir +</a>
            </div>
            <div class="card-footer text-muted">
                Ajouté le <?php echo $last_article->getFrDate($last_article->getDate()); ?>
            </div>
        </article>
    </div>
    <?php endforeach ?>
    </div>
</div>
<br>
<br>
<h4>Découvrez nos nouveaux produits</h4>
<hr>
<div class="row">
<div class="card-deck">
    <?php foreach ($last_pdts as $last_pdt) : ?>
    <div class="col-sm-4">
        <article>
            <div class="card">
                <?php if($last_pdt->getImage() != NULL) : ?>
                    <img class="card-img-top" src="<?php echo \Lib\Application::$racine ?>images/<?php echo $last_pdt->getImage() ?>" alt="<?php  htmlspecialchars( $last_pdt->getTitre());?>">
                <?php endif ?>
            </div>
            <div class="card-block">
                <h2 class="card-title"><?php echo  $last_pdt->getTitre(); ?></h2>
                <h5><?php echo $last_pdt->getPrixEuro(); ?></h5>
                <p><?php echo $last_pdt->getExtrait(); ?></p>
                <a href="<?php echo  \Lib\Application::$racine ?>catalogue/detail/<?php echo $last_pdt->getSlug() ?>" class="btn btn-primary">En savoir +</a>
            </div>
            <div class="card-footer text-muted">
                Ajouté le <?php echo $last_pdt->getFrDate($last_pdt->getDate()); ?>
            </div>
        </article>
    </div>
    <?php endforeach ?>
</div>
</div>



