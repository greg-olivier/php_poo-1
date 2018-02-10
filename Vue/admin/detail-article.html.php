
<article>
    <button class="btn" onclick="location.href='<?php echo \Lib\Application::RACINE ?>admin'">Retour</button>
    <button class="btn btn-default dropdown-toggle" type="button" id="action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        Actions
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="action">
        <li><a href="<?php echo \Lib\Application::RACINE ?>admin/edit/<?php echo $current_article->getSlug(); ?>">Modifier</a></li>
        <li><a href="#" onClick="ConfirmMessage()" >Supprimer</a></li>
    </ul>

    <header>
        <h1>
            <?php echo  $current_article->getTitre(); ?>
        </h1>

        Le <?php echo $current_article->getFrDate($current_article->getDate()); ?>
    </header>

    <hr>

    <?php echo  $current_article->getContenu(); ?>
<br>
<!--    <div class="thumbnail" style="height:200px;width:200px">-->
        <div class="img-fluid" style="height:200px;width:200px;">
   <?php if($current_article->getImage()->getFilename() != NULL) : ?>
        <img class="float-left" src="<?php echo \Lib\Application::RACINE.'images/'. $current_article->getImage()->getFilename(); ?>" alt="<?php echo htmlspecialchars($current_article->getTitre());?>">
    <?php endif ?>
        </div>
    </div>


</article>

<script type="text/javascript">
    function ConfirmMessage() {
        if (confirm("Etes-vous sûr de vouloir supprimer cet article ?")) {
            // Clic sur OK
            document.location.href="<?php echo \Lib\Application::RACINE ?>admin/delete/<?php echo $current_article->getSlug() ?>";
        } else {
            document.location.href="<?php echo \Lib\Application::RACINE ?>admin/detail/<?php echo $current_article->getSlug() ?>";
        }
    }
</script>