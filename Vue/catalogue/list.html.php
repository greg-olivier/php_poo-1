<h2><?php echo $nb_items ?> produits disponibles</h2>
<br>
<a href="<?php echo \Lib\Application::RACINE; ?>catalogue">Retour</a>
<br>
<div class="card-columns">
    <?php foreach ($all_products as $all_product) : ?>

        <div class="card mb-4">
            <?php if($all_product->getImage() != NULL) : ?>
                <img class="card-img-top" src="<?php echo \Lib\Application::RACINE .'images/'. $all_product->getImage() ?>" alt="<?php  htmlspecialchars($all_product->getTitre());?>">
            <?php endif ?>
            <div class="card-body">
                <h2 class="card-title"><?php echo $all_product->getTitre(); ?></h2>
                <h5><?php echo $all_product->add_euro($all_product->getPrix()); ?></h5>
                <p><?php echo $all_product->getExtrait(); ?></p>
                <a href="<?php echo \Lib\Application::RACINE;?>catalogue/product-<?php echo $all_product->getId() ?>" class="btn btn-primary">En savoir +</a>
            </div>
            <div class="card-footer text-muted">
                Ajouté le <?php echo $all_product->getFrDate($all_product->getDate(),'%d/%m/%g'); ?>
            </div>
        </div>

        <hr/>
    <?php endforeach ?>
</div>