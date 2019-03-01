<!DOCTYPE html>
<html>
    <head>
        <title>(e-bank)-mes_reliquats</title>
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
                                    <li class="disabled"><a href="#">mes réliquats</a></li>
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
                                    <li class="disabled"><a href="#">mes réliquats</a></li>
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
        <h2>Mes reliquats</h2>
    </div>
    <div class="alert alert-success" id="alert">
        <p style="color:green"><?php echo $text ?></p>  
    </div>
    <div class="big-content">
        <p class="solde">Votre solde : <?php echo $_SESSION['user']->solde ?> franc CFA</p><br><br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <?php 
                        $stat = $db->prepare('SELECT * FROM pret WHERE id_user = ? ORDER BY id DESC');
                        $stat->execute([$_SESSION['user']->id]); 
                        $count = $stat->rowCount();
                        if($count == 0)
                        {
                            echo '<p>vous n\'avez aucun réliquat récent</p>';
                        }
                        else
                        {
                    ?>
                    <table class="responsive-tab-line table-striped table-bordered">
                        <thead>
                            <th>N°</th>
                            <th>Montant du reliquat</th>
                            <th>Date du prêt</th>
                            <th>rembourser</th>
                            <th>date de remboursement</th>
                            <th>action</th>
                        </thead>
                        <tbody>
                        <?php
                            $i = 1;
                            $stat = $db->prepare('SELECT * FROM pret WHERE id_user = ? ORDER BY id DESC');
                            $stat->execute([$_SESSION['user']->id]);
                            while($row = $stat->fetch())
                            {  ?>
                                    <tr>
                                    <td><?php echo $i ?></td>
                                     <td><?php echo $row['montant_du_pret'] ?> fcfa</td>
                                     <td><?php echo getsdate($row['date_de_pret']) ?></td>
                                     <td><?php echo $row['rembourser'] ?></td>
                                     <td><?php
                                        if($row['rembourser'] == "oui")
                                        {
                                            echo  getsdate($row['date_rembourser']);
                                        }
                                        else
                                        {
                                            echo 'pas encore rembourser';
                                        }
                                          ?></td>
                                     <td>
                                         <?php 
                                        if($row['rembourser'] == "oui")
                                        {
                                            echo  '<form method="post" action="" style="background: none;border:none;padding: 5px;">
                                            <input type="hidden" name="id" value="'.$row['id'].'">
                                            <button type="submit" name="supp_reliquat" class="btn btn-danger"><span class="fa fa-trash-o"></span> supprimer</button>
                                            </form>';
                                        }
                                        else
                                        {
                                            echo '<a class="btn btn-success" href="index.php?r=rembourser_pret"><span class="fa fa-dollar"></span> rembourser</a>';
                                        } ?>
                                        </td>
                                    </tr>
                            <?php $i++; }
                        }
    
                        ?>
                        </tbody>
                    </table>
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