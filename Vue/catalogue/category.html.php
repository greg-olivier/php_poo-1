<a href="<?php \Lib\Application::RACINE; ?>catalogue">Retour</a>
<br>
<h1><?php echo $category_products[0]->getCategory()->getNb(); ?> produit(s) dans la categorie <?php echo $category_products[0]->getCategory()->getTitre(); ?></h1>
<br>
<div class="card-columns">
<?php foreach ($category_products as $category_product) : ?>

            <div class="card mb-4">
                <?php if($category_product->getImage()!= NULL) : ?>
                    <img class="card-img-top" src="<?php echo \Lib\Application::RACINE .'images/'. $category_product->getImage() ?>" alt="<?php  htmlspecialchars($category_product->getTitre());?>">
                <?php endif ?>
                <div class="card-body">
                    <h2 class="card-title"><?php echo $category_product->getTitre(); ?></h2>
                    <h5><?php echo $category_product->add_euro($category_product->getPrix()); ?></h5>
                   <p><?php echo $category_product->getExtrait(); ?></p>
                    <a href="<?php echo \Lib\Application::RACINE ?>catalogue/product-<?php echo $category_product->getId() ?>" class="btn btn-primary">En savoir +</a>
                </div>
                <div class="card-footer text-muted">
                    Ajouté le <?php echo $category_product->getFrDate($category_product->getDate(),'%d/%m/%g'); ?>
                </div>
            </div>

<?php endforeach ?>
</div>
