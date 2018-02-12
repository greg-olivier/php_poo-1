<h1><?php echo $titre ?></h1>
<br>
<a href="<?php \Lib\Application::$racine ?>catalogue/allproducts">Liste de tous les produits</a>
<br>
<br>
<?php foreach ($all_categories as $all_category) :
    if ($all_category->getNb()===0) : continue; else : ?>
        <a href="<?php echo \Lib\Application::$racine ?>catalogue/categorie-<?php echo $all_category->getId() ?>">
                <h3>
                    <?php echo $all_category->getTitre(); ?>
                </h3>
            <p>Nombre de produits :<?php echo $all_category->getNb(); ?></p>
        </a>
    <?php endif; ?>
    <br/>
<?php endforeach ?>