<!DOCTYPE html>
<html>
    <head>
        <title>(e-bank)-home</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width initial-scale=1">
        <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="public/bootstrap/css/font-awesome.css" />
        <link rel="stylesheet" href="public/bootstrap/css/style.css">
    </head>
    <body>
        <div id="home">
            <header>
                <div class="title">
                    <h2>e-Bank</h2>
                </div>
                <div class="men_prin">
                <nav class="navbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Acceuil</a></li>
                        <li><a href="index.php?r=pret">Contracter un prêt</a></li>
                        <li><a href="index.php?r=rembourser_pret">Rembourser un prêt</a></li>
                        <li><a href="index.php?r=transactions">Effectuer une transaction</a></li>
                    </ul>
                </nav>
                    <div class="menu">
                     <?php 
                    if(isset($_SESSION['user']))
                    { ?>
                        <ul>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown"><img src="public/images/<?php echo $_SESSION['user']->image ?>" width="45px" height="45px" class="img-circle"/><span><?php echo $_SESSION['user']->nom.' '.$_SESSION['user']->prenoms;?></span>  <span class="fa fa-arrow-down"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php?r=modifier_profil">modifier mon profil</a></li>
                                    <li><a href="index.php?r=mytransactions">mes transactions</a></li>
                                    <li><a href="index.php?r=mycredits">mes réliquats</a></li>
                                    <li><a href="index.php?r=deconnexion">Déconnexion</a></li>
                                </ul>
                            </li>
                        </ul>            
            <?php }
                  else
                  {
                      header('Location: index.php?r=index');
                  }
                    ?>
                </div>
                </div>
                <div class="menu_trigger ouvre">
                    <span class="fa fa-bars"></span>
                </div>
                <div class="menu_trigger ferme">
                    <span class="fa fa-remove"></span>
                </div>
                <div class="menu-hidden">
                    <h4>Menu</h4>
                     <nav class="navbar">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Acceuil</a></li>
                            <li><a href="index.php?r=pret">Contracter un prêt</a></li>
                            <li><a href="index.php?r=rembourser_pret">Rembourser un prêt</a></li>
                            <li><a href="index.php?r=transactions">Effectuer une transaction</a></li>
                        </ul>
                    </nav>
                     <div class="menu">
                     <?php 
                    if(isset($_SESSION['user']))
                    { ?>
                        <ul>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown"><img src="public/images/<?php echo $_SESSION['user']->image ?>" width="45px" height="45px" class="img-circle"/>   <span><?php echo $_SESSION['user']->nom.' '.$_SESSION['user']->prenoms;?></span>  <span class="fa fa-arrow-down"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php?r=modifier_profil">modifier mon profil</a></li>
                                    <li><a href="index.php?r=mytransactions">mes transactions</a></li>
                                    <li><a href="index.php?r=mycredits">mes réliquats</a></li>
                                    <li><a href="index.php?r=deconnexion">Déconnexion</a></li>
                                </ul>
                            </li>
                        </ul>            
            <?php }
                  else
                  {
                      header('Location: index.php?r=index');
                  }
                    ?>
                </div>
                </div>
            </header>