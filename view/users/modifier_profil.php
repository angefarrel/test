<!DOCTYPE html>
<html>
    <head>
        <title>(e-bank)-modification_profil</title>
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
                                    <li class="disabled"><a href="#">modifier mon profil</a></li>
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
                                    <li class="disabled"><a href="#">modifier mon profil</a></li>
                                    <li><a href="indeX.php?r=mytransactions">mes transactions</a></li>
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
        <h2>Modifier mon profil</h2>
    </div>    
     <div class="alert alert-danger" id="alert">
        <p><?php echo $Error ?></p>  
    </div>
    <div class="big-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <ul class="nav nav-pills">
                            <li role="presentation" class="active"><a href="#1" data-toggle="tab">modifier mes informations</a></li>
                            <li role="presentation"><a class="table2" href="#2" data-toggle="tab">modifier mon mot de passe</a></li>
                        </ul>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="1">
                            <div id="big_content">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                             <div class="image-viewer" style="text-align: center;">
                                                <img class="img_apercu" src="public/images/<?php echo $_SESSION['user']->image?>" class="responsive"/><br>
                                                <span class="btn btn-primary btn-sm" onclick="choisirPhoto
                                                (this);">Choisir une nouvelle image</span>
                                                <input type="file" class="form-control" name="image" style="display:
                                                none;" onchange="show_apercu(this);"  value="<?php echo $_SESSION['user']->image?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Entrez un nouvel email</label>
                                                <input type="email" name="email" class="form-control" value="<?php echo $_SESSION['user']->email ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Nouveau numéro de carte banquaire</label>
                                                <input type="text" name="num_cart" class="form-control" value="<?php echo $_SESSION['user']->numero_compte_bancaire ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Entrez un nouvel contact</label>
                                                <input type="number" name="contacts" class="form-control" value="<?php echo $_SESSION['user']->contacts ?>">
                                            </div> 
                                        </div>
                                    </div>
                                    <input type="submit" name="modif_infos" id="connex" class="form-control" value="modifier">
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="2">
                            <div id="big_content">
                                <form method="post" action="index.php?r=modifier_profil">
                                    <input type="password" name="holdpw" class="form-control" placeholder="Entre votre ancien mot de passe" required>
                                    <input type="password" name="newpw" class="form-control" placeholder="Entre votre nouveau mot de passe" required>
                                    <input type="password" name="confirmpw" class="form-control" placeholder="confirmez le nouveau mot mot de passe" required>
                                    <input type="submit" name="modif_password" class="form-control" value="modifier">
                                </form>
                            </div>
                        </div>
                    </div>
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
                            <p>modification efffecuté avec succès</p>
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
     <script type="text/javascript">
            function choisirPhoto(x)
            {
                $(x).parents('.image-viewer').children('input[type="file"]').click();
            }
            function show_apercu(x)
            {
                var files = jQuery(x)[0].files;
                if(files.length > 0)
                {
                    var file=files[0];
                    if(file.size<=2*1024*1024)
                    {
                        var file=files[0];
                        $(x).prevAll('.file-name' ).html(file.name+"&nbsp;&nbsp;("+parseInt(file.size/1024)+'Ko)');
                        $(x).prevAll('.img_apercu' ).attr('src' , window.URL.createObjectURL(file));
                        $(x).prevAll('.img_apercu').show();
                        $(x).parent('.image-viewer').children('a').show();
                    }else
                    {
                        alert("Image trop lourde, le poids doit être inférieur à 2 Mo");
                    }
                }
            }
            function removeFile(x)
            {
                $(x).nextAll('input').val("");
                $(x).prevAll('.file-name').html("");
                $(x).prevAll('.img_apercu' ).hide();
                $(x).parent('.image-viewer').children('a').hide();
            }
        </script>
    </body>
</html>