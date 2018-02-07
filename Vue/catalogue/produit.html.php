
<article>
    <a href="<?php echo \Lib\Application::RACINE ?>catalogue/categorie-<?php echo $current_product->getCategory()->getId(); ?>">Retour</a>
    <header>
        <h1>
            <?php echo $current_product->getTitre(); ?>
        </h1>

        <i>catégorie : <?php echo $current_product->getCategory()->getTitre(); ?>, ajouté le <?php echo $current_product->getFrDate($current_product->getDate()); ?></i><br>

        <br>
        <?php echo $current_product->add_euro($current_product->getPrix()); ?>
    </header>

    <hr>

    <?php echo $current_product->getContenu(); ?>
    <br>
    <!--    <div class="thumbnail" style="height:200px;width:200px">-->
    <div class="img-fluid" style="height:200px;width:200px;">
        <?php if($current_product->getImage() != NULL) : ?>
            <img class="float-left" src="<?php echo \Lib\Application::RACINE.'images/'. $current_product->getImage(); ?>" alt="<?php echo htmlspecialchars($current_product->getTitre());?>">
        <?php endif ?>
    </div>
    </div>


</article>