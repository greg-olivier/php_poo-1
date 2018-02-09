<div class="jumbotron text-center">

    <h1>Connexion</h1>
    <?php if ($_SERVER['REQUEST_METHOD']=='POST'): ?>
    <?php if ($erreurs != []): ?>
            <div class="erreur">
               <?php foreach ($erreurs as $erreur): ?>
               <p><?php echo $erreur ?></p>
                <?php endforeach; ?>
            </div>
    <?php endif ?>
    <?php endif ?>
<div class="form-con">
    <form method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="nom" placeholder="Saisissez votre login...">
            <input type="password" class="form-control" name="pass" placeholder="... et votre mot de passe">
        </div>

        <input type="hidden" name="token" value="<?php echo $token ?>">
        <button type="submit" class="btn btn-primary" name="OK" value="OK">Envoyer</button>
    </form>
<br>
    <a class="register-link" href="?page=register">Pas encore inscrit ? Inscrivez-vous</a>
</div>
</div>