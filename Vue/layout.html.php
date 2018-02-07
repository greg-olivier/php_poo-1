
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">

        <title>Titre du site</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo \Lib\Application::RACINE ?>css/style.css">

        <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.2/classic/ckeditor.js"></script>

    </head>

    <body>

        <nav class="navbar navbar-expand-md navbar-dark fixed-top">
            <a class="logo" href="<?php echo \Lib\Application::RACINE ?>">Logo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo \Lib\Application::RACINE; ?>catalogue">Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo \Lib\Application::RACINE; ?>blog">Le Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo \Lib\Application::RACINE; ?>contact">Contact</a>
                    </li>
                    <?php if (isset($_SESSION['auth']) AND $_SESSION['auth'] === true AND isset($_SESSION['titre'])) :?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo \Lib\Application::RACINE; ?>admin">Administration</a>
                        </li>
                    <?php elseif (isset($_SESSION['auth']) AND ($_SESSION['auth'] === true) AND (!isset($_SESSION['titre']))) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo \Lib\Application::RACINE; ?>membre">Mon Espace</a>
                    </li>
                    <?php endif; ?>
                        <?php if (isset($_SESSION['auth']) AND $_SESSION['auth'] === true) : ?>
                            <li class="nav-item">
                        <a class="nav-link" href="<?php echo \Lib\Application::RACINE; ?>disconnect">Déconnexion</a>
                    </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo \Lib\Application::RACINE; ?>connect">Connexion</a>
                        </li>
                    <?php endif; ?>

                </ul>
                <form class="form-inline my-2 my-lg-0" method="get">
                    <input class="form-control mr-sm-2" name="data" type="text" placeholder="search" aria-label="search">
                    <button class="btn btn-default" type="submit" name="submit" value="ok"><span class="glyphicon glyphicon-search" style="color:white"></span>Search</button>
                </form>
            </div>
        </nav>



        <main role="main" class="container">

            <div class="starter-template">
                <?php echo $contenu ?>
<!--                --><?php //include __DIR__ . '/../inc/' . $file; ?>
            </div>

        </main><!-- /.container -->

        <footer class="footer">
            <div class="container">
                <form class="form-inline my-2 my-lg-0" action="?page=newsletter" method="post">
                    <input class="form-control mr-sm-2" name="mail_newsletter" type="email" placeholder="Votre email" aria-label="email">
                    <button class="btn btn-default" type="submit" name="suscribe" value="ok"><span class="glyphicon glyphicon-envelope" style="color:white"></span>Suscribe</button>
                </form>
            </div>
        </footer>


        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                console.error( error );
            } );
        </script>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>


    </body>
</html>










