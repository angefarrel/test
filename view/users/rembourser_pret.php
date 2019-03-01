<!DOCTYPE html>
<html>
    <head>
        <title>(e-bank)-rembourser_pret</title>
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
                        <li><a href="index.php?r=home">Acceuil</a></li>
                        <li><a href="index.php?r=pret">Contracter un prêt</a></li>
                        <li class="active"><a href="#">Rembourser un prêt</a></li>
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
                        <li><a href="index.php?r=home">Acceuil</a></li>
                        <li><a href="index.php?r=pret">Contracter un prêt</a></li>
                        <li class="active"><a href="#">Rembourser un prêt</a></li>
                        <li><a href="index.php?r=transactions">Effectuer une transaction</a></li>
                    </ul>
                </nav>
                     <div class="menu">
                     <?php 
                    if(isset($_SESSION['user']))
                    { ?>
                        <ul>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown"><img src="public/images/<?php echo $_SESSION['user']->image ?>" width="45px" height="45px" class="img-circle"/>  <span><?php echo $_SESSION['user']->nom.' '.$_SESSION['user']->prenoms;?></span>  <span class="fa fa-arrow-down"></span></a>
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
    <div class="banner">
        <h2>Rembourser un prêt</h2>
    </div>
    <div class="alert alert-danger" id="alert">
        <p><?php echo $Error ?></p>  
    </div>
    <div class="big-content">
         <?php 
            $request = $db->prepare('SELECT * FROM pret WHERE id_user = ? AND rembourser ="non"');
            $request->execute([$_SESSION['user']->id]);
            $get = $request->fetch();
            $cnt = $request->rowCount();
            if($cnt == 0)
            { ?>
                <p>vous n'avez aucun prêt à rembourser</p>
        <?php } 
             else
             { ?>
                 <p>Rembourser  votre prêt avec un intérêt de 10% uniquement</p>
                 <p class="solde">Votre solde : <?php echo $_SESSION['user']->solde ?> franc CFA</p><br>
                 <p><span class="text">Dernier prêt en date : </span> <?php echo getsdate($get['date_de_pret']) ?><br><span class="text">Montant : </span><?php echo $get['montant_du_pret'] ?> fcfa<br><span class="text">Total à rembourser: </span><?php echo $get['montant_du_pret']+($get['montant_du_pret']*10/100) ?> fcfa</p>
                <?php 
                    $mt = $get['montant_du_pret']+($get['montant_du_pret']*10/100);
                    if($_SESSION['user']->solde > $mt)
                    {
                      echo ' <div class="container">
                                <div class="row">
                                    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                                    <form method="post" action="" id="form">
                                        <input type="number" name="montant_pret" placeholder="Entrez le montant du prêt que vous voulez contracter" required class="form-control" value="'.$montant.'">
                                        <input type="text" name="num_cart" placeholder="Entrez le numéro de votre compte bancaire" required class="form-control" value="'.$num_banq.'">
                                        <input type="password" name="mot_de_passe" placeholder="Entrez Votre mot de passe" required class="form-control" value="'.$mot_de_passe.'">
                                        <input type="submit" name="pret" value="Envoyer" class="form-control">
                                    </form>
                                    </div>
                                </div>
                            </div>';  
                    }
                    else
                    {
                        echo '<p>votre solde est inférieur au montant à solder</p>';
                    }
                 }
        ?>
    </div>
        <?php include('view/include/footer.php'); ?>
    </div>
    <div class="modal fade" id="sup_paysan" role="dialog" aria-hidden="true">
        <div class="modal-dialog container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-12">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>prêt effecuté avec succès.<br>votre nouveau solde est de <?php echo $_SESSION['user']->solde ?> FCFA. vous devez-rembourser ce prêt dans un délais de 30 jours avec 10% d'intérêt soit <span style="font-weight:bolder"><?php echo $sommeTotal ?></span> FCFA</p>
                            <a class="oui">ok</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <script src="public/bootstrap/js/jquery-3.3.1.min.js"></script>
     <script src="public/bootstrap/js/bootstrap.min.js"></script>
     <script>
        function efface_formulaire() 
         {
            $( ':input' ).not( ':button,:submit,:reset,:hidden').val('').prop('checked',false).prop( 'selected',true);
        }
     </script>
    <script>
            $(function()
             {
                $('.ferme').hide();
                $('.ouvre').click(function(){
                    $('.menu-hidden').fadeIn(500);
                    $('.ouvre').hide();
                    $('.ferme').show();
                });
                $('.ferme').click(function(){
                    $('.menu-hidden').fadeOut(500);
                    $('.ouvre').show();
                    $('.ferme').hide();
                });
            });
       </script>
    </body>
</html>