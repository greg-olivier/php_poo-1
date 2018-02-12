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
                <textarea name="titre" class="form-control" rows="1" cols="150"></textarea>
            </h1>
        </header>

        Contenu :<br>
        <textarea name="contenu" class="form-control" id="editor" rows="15" cols="150"></textarea>
        <br>

        Image de l'article:<br>
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <input type="file" name="fichier_image" /><br />

        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="publier" value="1">
            <label class="form-check-label" for="publier">Publié ?</label>
          </div>



        <input type="hidden" name="token" value="<?php echo $token ?>">

        <button class="btn btn-primary" type="submit" name="update">Enregistrer l'article</button>
    </form>
    <a class="btn" href="<?php echo \Lib\Application::$racine ?>admin">Annuler</a>
</article>