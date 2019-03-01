<!DOCTYPE html>
<html>
    <head>
         <title>e-bank</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width initial-scale=1">
        <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="public/bootstrap/css/font-awesome.css" />
        <link rel="stylesheet" href="public/bootstrap/css/style.css">
    </head>
    <body style="background-image: url('public/images/e-bank2.jpg'); background-size:cover;">
         <div class="alert alert-danger" id="error">
        <p><span class="fa fa-warning"></span> Désolé,nous nous ne reconnaissons pas ces informations.<br>Si vous n'avez pas de compte, veuillez créer un compte en cliquant <a href="index.php?r=inscription" style="font-weight:bolder;font-size: 25px;color: green">ici</a></p>  
      </div>
        <div id="big_content" class="container">
            <h1><span class="e">e</span>-Bank</h1>
            <p>Votre solution numérique pour la gestion de votre compte</p>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                    <form method="post" action="">
                        <h3>Connectez-vous à votre compte</h3>
                        <input type="text" name="num" class="form-control" placeholder="Entrez votre numéro de compte bancaire svp" required>
                        <input type="password" name="motDePasse" class="form-control" placeholder="Entrez votre mot de passe" required>
                        <input type="submit" name="connexion" class="form-control" value="connexion">
                        <span class="help-block">Pas encore de compte,créer un compte <a href="index.php?r=inscription" style="color: deepskyblue;font-weight: bolder;">ici</a></span>
                    </form>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                    <div class="carousel slide" id="slide">
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#slide" data-slide-to="0"></li>
                            <li data-target="#slide" data-slide-to="1"></li>
                           <li  data-target="#slide" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="carousel-page">
                                    <h1>Un service simple,rapide et éfficace en toute sécurité</h1>
                                </div>
                            </div>
                            <div class="item">
                                <div class="carousel-page">
                                    <h1>Avec E-Bank,plus la peine de se déplacer pour envoyer de l'argent</h1>
                                </div>
                            </div>
                            <div class="item">
                                <div class="carousel-page">
                                    <h1>Avec E-Bank,C'est aussi des prêts à hauteur de 10 millions de fcfa</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="public/bootstrap/js/jquery-3.3.1.min.js"></script>
        <script src="public/bootstrap/js/bootstrap.min.js"></script>
        
    </body>
</html>