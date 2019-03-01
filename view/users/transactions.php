<!DOCTYPE html>
<html>
    <head>
        <title>(e-bank)-transaction</title>
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
                        <li><a href="index.php?r=rembourser_pret">Rembourser un prêt</a></li>
                        <li class="active"><a href="#">Effectuer une transaction</a></li>
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
                        <li><a href="index.php?r=rembourser_pret">Rembourser un prêt</a></li>
                        <li class="active"><a href="#">Effectuer une transaction</a></li>
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
        <h2>Effectuer une transaction</h2>
    </div>
    <div class="alert alert-danger" id="alert">
        <p><?php echo $Error ?></p>  
    </div>
    <div class="big-content">
        <p>Effectuer votre transaction simplement,librement et en toute sécurité</p><br>
        <p class="solde">Votre solde : <?php echo $_SESSION['user']->solde ?> franc CFA</p><br><br>
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                    <form method="post" action="" id="form">
                          <select class="form-control" name="pays" required >
                                <option selected value="<?php echo $pays ?>" ><?php echo $pays ?></option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Algerie">Algérie</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Cap vert">Cap vert</option>
                                <option value="Congo">Congo</option>
                                <option value="Guinee">Guinée</option>
                                <option value="Mali">Mali</option>
                                <option value="Mauritanie">Mauritanie</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Togo">Togo</option>
                                <option value="Zimbabwe">Zimbabwé</option>
                            </select>
                          <select class="form-control" name="banque" required>
                                <option selected value="<?php echo $banque ?>" ><?php echo $banque ?></option>
                                <option value="Banque Atlantique">Banque Atlantique</option>
                                <option value="Coris Bank">Coris Bank</option>
                                <option value="E-bank">E-bank</option>
                                <option value="Ecobank">Ecobank</option>
                                <option value="NSIA">NSIA</option>
                                <option value="SGBCI">SGBCI</option>
                            </select>
                <input type="text" name="num_compt_bancaire" placeholder="Entrez le numéro de carte bancaire du bénéficaire" required class="form-control" value="<?php echo $num_cart ?>">
                <input type="number" name="contacts_beneficaire" placeholder="Entrez le contact du bénéficiaire" required class="form-control" value="<?php echo $contacts ?>">
                <input type="number" name="montant_transfere" placeholder="Entrez le montant a transfére" required class="form-control" value="<?php echo $montant ?>">
                <input type="submit" name="transaction" value="tranférer" class="form-control">
            </form>
                </div>
            </div>
        </div>
    </div>
        <?php include('view/include/footer.php'); ?>
    </div>
    <div class="modal fade" id="sup_paysan" role="dialog" aria-hidden="true">
        <div class="modal-dialog container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-12">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>transaction effecuté avec succès.<br>votre nouveau solde est de <?php echo $_SESSION['user']->solde ?> FCFA</p>
                            <a class="oui" data-dismiss="modal" data-target="#sup_paysan">ok</a>
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