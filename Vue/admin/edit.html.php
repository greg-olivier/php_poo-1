<?php if ($_SERVER['REQUEST_METHOD']=='POST'): ?>
    <?php if ($erreurs != []): ?>
        <div class="erreur">
            <?php foreach ($erreurs as $erreur): ?>
                <p><?php echo $erreur ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
<?php endif ?>
<article>
    <form method="post" enctype="multipart/form-data">
    <header>
        <h1>
            Titre :<br>
            <textarea name="titre" class="form-control" rows="1" cols="150"><?php echo $article_edit->getTitre(); ?></textarea>
        </h1>

        Date :<br>
        <textarea name="date" class="form-control" rows="1" cols="30"><?php echo  $article_edit->getDate()->format('Y-m-d H:i:s'); ?></textarea>
    </header>

        Contenu :<br>
        <textarea name="contenu" class="form-control" id="editor" rows="15" cols="150"><?php echo $article_edit->getContenu(); ?></textarea>
    <br>

        Image de l'article:<br>
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <input type="file" name="fichier_image" /><?php echo $article_edit->getImage()->getFilename() ?><br />

        <div class="form-check">

            <input type="checkbox" class="form-check-input" name="publier" value="1" <?php if ($article_edit->getPublier() == 1) :?>checked<?php endif?>>
            <label class="form-check-label" for="publier">Publié ?</label>
        </div>



        <input type="hidden" name="token" value="<?php echo $token ?>">

        <button class="btn btn-primary" type="submit" name="update">Enregistrer les modifications</button>

    </form>
    <a class="btn btn-default" href="<?php echo \Lib\Application::$racine ?>admin/detail/<?php echo $article_edit->getSlug() ?>">Annuler</a>
</article>
