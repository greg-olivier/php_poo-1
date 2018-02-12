
<article>
    <a href="<?php echo \Lib\Application::$racine ?>blog">Retour</a>
    <header>
        <h1>
            <?php echo $current_article->getTitre(); ?>
        </h1>

        Le <?php echo $current_article->getFrDate($current_article->getDate()); ?>, par <?php echo $current_article->getAuteur()->getNom(); ?>
    </header>

    <hr>

    <?php echo $current_article->getContenu(); ?>
<br>
<!--    <div class="thumbnail" style="height:200px;width:200px">-->
        <div class="img-fluid" style="height:200px;width:200px;">
   <?php if($current_article->getImage()->getFilename()!= NULL) : ?>
        <img class="float-left" src="<?php echo \Lib\Application::$racine.'images/'. $current_article->getImage()->getFilename(); ?>" alt="<?php echo htmlspecialchars($current_article->getTitre());?>">
    <?php endif ?>
        </div>
    </div>


</article>