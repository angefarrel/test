<!DOCTYPE html>
<html>
    <head>
        <title>(e-bank)-inscription</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width initial-scale=1">
        <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="public/bootstrap/css/font-awesome.css" />
        <link rel="stylesheet" href="public/bootstrap/css/style.css">
    </head>
    <body style="background-image: url('public/images/e-bank2.jpg'); background-size:cover;">
        <div class="alert alert-danger" id="alert">
            <p><?php echo $Error ?></p>  
          </div>
        <div id="big_content" class="container">
            <h1>Inscription</h1>
             <p>ça ne vous prendra pas 2 minutes</p>
            <div class="row">
                <div class="col-lg-offset-1 col-md-offset-1 col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <form method="post" action="" enctype="multipart/form-data"s>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: center;">
                                <div class="image-viewer" style="">
                                    <span class="help-block" style="color: darkgrey;line-height: 1em;font-size: 17px;">nous avons besoin de vous indentifier physiquement</span>
                                    <img class="img_apercu" src="public/images/new.png" class="responsive"/><br>
                                    <span class="btn btn-primary btn-sm" onclick="choisirPhoto
                                    (this);">Choisir une image</span>
                                    <input type="file" class="form-control" name="image" style="display:
                                    none;" onchange="show_apercu(this);" accept="image/*"/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <input type="text" name="nom" class="form-control" placeholder="Entrez votre nom svp" value="<?php echo $nom ?>" required>
                                <input type="text" name="prenoms" class="form-control" placeholder="Entrez votre prenoms svp" value="<?php echo $prenoms ?>" required>
                                <input type="email" name="email" class="form-control" placeholder="Entrez votre email svp" value="<?php echo $email ?>" required>
                                <input type="number" name="contacts" class="form-control" placeholder="Entrez vos contacts svp" value="<?php echo $contacts ?>" required>
                                <input type="text" name="numero_banq" class="form-control" value="<?php echo $num_banq ?>" placeholder="Entrez votre numéro de compte bancaire svp" required>
                                <input type="password" name="motDePasse" class="form-control" placeholder="Entrez votre mot de passe"  value="<?php echo $mot_de_passe ?>" id="p1" required>
                                <input type="password" name="confirmMotDePasse" class="form-control" placeholder="Confirmez votre mot de passe" value="<?php echo $mot_de_passe ?>" id="p2" onkeyup="verif();" onchange="verif();" required>
                                <span class="error" style="display: none">les mots de passe ne concordent pas</span>
                            </div>
                        </div>
                        <input type="submit" name="inscription" id="connex" style="display: none" class="form-control" value="envoyer">
                    </form>
                </div>
                </div>
            </div>
              <div class="modal fade" id="sup_paysan" role="dialog" aria-hidden="true">
                        <div class="modal-dialog container-fluid">
                            <div class="row">
                                <div class="col-lg-12 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-12">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <p>inscription effecuté avec succès vous pouvez désormais vous connectez à votre compte</p>
                                            <a class="oui" href="index.php?r=index">ok</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <script src="public/bootstrap/js/jquery-3.3.1.min.js"></script>
        <script src="public/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            function verif()
            {
               var p1 = $('#p1').val(),p2 = $('#p2').val();
               if(p1 != p2)
                {
                    $('.error').fadeIn(300);
                    $('.error').text('les mots de passe ne concordent pas');
                    $('.error').css('color','red');
                    $('#p2').css('border','1px solid red');
                    $('#connex').fadeOut(300);
                }
                else
                {
                    $('#connex').fadeIn(300);
                     $('#p2').css('border','1px solid darkgrey');
                    $('.error').text('les mots de passe concordent parfaitement');
                    $('.error').css('color','darkgreen');
                }
            }
            function choisirPhoto(x)
            {
                $(x).parents('.image-viewer' ).children('input[type="file"]').click();
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