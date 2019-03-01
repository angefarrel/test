<?php 
    include('model/user.php');
    function index()
    {
        if(isset($_POST['connexion']))
        {
            $_SESSION['user'] = getUser($_POST['num'],$_POST['motDePasse']);
            if(isset($_SESSION['user']))
            {
                header('Location: index.php?r=home');
            }
        }
        include('view/index.php');
    }
    function inscription()
    {
        include('model/database.php');
        $Error = $nom = $prenoms = $email = $num_banq = $mot_de_passe = $contacts =  $image = "";
        if(isset($_POST['inscription']) && !empty($_POST))
        {
            $nom = $_POST['nom'];
            $prenoms = $_POST['prenoms'];
            $email = $_POST['email'];
            $num_banq = $_POST['numero_banq'];
             $contacts = $_POST['contacts'];
            $mot_de_passe = $_POST['confirmMotDePasse'];
            $image = $_FILES['image']['name'];
            $imagePath = 'public/images/'.basename($image);
            $imageExtension= pathinfo($imagePath, PATHINFO_EXTENSION);
            $success = true;
            $isUploaded = true;
            if(empty($image))
            {
                $stat = $db->prepare('INSERT INTO users (nom,prenoms,image,email,numero_compte_bancaire,solde,contacts,mot_de_passe) VALUES(?,?,?,?,?,?,?,?)');
                $stat->execute([$nom,$prenoms,"new.png",$email,$num_banq,1000000,$contacts,$mot_de_passe]);
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                    <script>
                        $(function()
                        {
                            $('#sup_paysan').modal('show');
                        })
                    </script>";
            }
            else
            {
                 if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif")
                {
                    $Error ="<span class='fa fa-warning'></span> les images autorisés sont jpeg , jpg , png et gif";
                    echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                     <script>
                        $(function()
                        {
                            $('#alert').fadeIn(300).delay(3000).fadeOut(300);
                            $('#connex').show();
                        })
                     </script>";
                    $isUploaded = false;
                }
                if($isUploaded)
                {
                    if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
                    {
                        $Error ="<span class='fa fa-warning'></span> il y'a eu error lors du chargement de l'image";
                        echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                         <script>
                            $(function()
                            {
                                $('#alert').fadeIn(300).delay(3000).fadeOut(300);
                                $('#connex').show();
                            })
                         </script>";
                        $success = false;
                        $isUploaded = false;
                    }
                }
                if($success && $isUploaded)
                {
                     $stat = $db->prepare('INSERT INTO users (nom,prenoms,image,email,numero_compte_bancaire,solde,contacts,mot_de_passe) VALUES(?,?,?,?,?,?,?,?)');
                    $stat->execute([$nom,$prenoms,$image,$email,$num_banq,1000000,$contacts,$mot_de_passe]);
                    echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                        <script>
                            $(function()
                            {
                                $('#sup_paysan').modal('show');
                            })
                        </script>";
                }
            }
        }
        include('view/inscription.php');
    }
    function home()
    {
        include('view/users/home.php');
    }
    function pret()
    {
        include('model/function.php');
        include('model/database.php');
        $montant = $num_banq = $mot_de_passe = $Error = "";
        if(isset($_POST['remb']))
        {
            $montant = $_POST['montant'];
            $num_banq = $_POST['num_cart'];
            $mot_de_passe = $_POST['password'];
            $success = true;
            $ver1 = true;
            $ver2 = true;
            if($num_banq != $_SESSION['user']->numero_compte_bancaire)
            {
                $Error = "<span class='fa fa-warning'></span> Votre numéro de carte banquaire ne correspond pas";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(5000).fadeOut(300);
                        $('#remb_pret').modal('show');
                    });
                 </script>";
                 $success = false;
                $ver1 = false;
            }
            elseif($mot_de_passe != $_SESSION['user']->mot_de_passe)
            {
                $Error = "<span class='fa fa-warning'></span>  Le mot de passe saisie est incorrect";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(5000).fadeOut(300);
                        $('#remb_pret').modal('show');
                    })
                 </script>";
                $success = false;
                $ver2 = false;
            }
            elseif(!$ver1 && !$ver2)
            {
                $Error = "<span class='fa fa-warning'></span>  Le mot de passe et votre numéro de compte banquaire ne conconrdent pas";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(10000).fadeOut(300);
                        $('#remb_pret').modal('show');
                    })
                 </script>";
            }
            if($success)
            {
                $solde_update = $_SESSION['user']->solde - $montant;
                $req = $db->prepare('UPDATE users SET solde = ? WHERE id = ?');
                $req->execute([$solde_update,$_SESSION['user']->id]);
                $_SESSION['user']->solde = $solde_update;
                $statement = $db->prepare('UPDATE pret SET rembourser="oui",date_rembourser = ? WHERE id_user = ?');
                $statement->execute([date('Y-m-d H:i:s',strtotime('-1 hours')),$_SESSION['user']->id]);
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                     <script>
                        $(function()
                        {
                            $('#remb_effect').modal('show');
                            efface_formulaire();
                        });
                     </script>";
            }
        }
        if(isset($_POST['pret']))
        {
            $montant = $_POST['montant_pret'];
            $num_banq = $_POST['num_cart'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $sommeTotal = $montant + ($montant*10/100);
            $success = true;
            $ver1 = true;
            $ver2 = true;
            if($num_banq != $_SESSION['user']->numero_compte_bancaire)
            {
                $Error = "<span class='fa fa-warning'></span> Votre numéro de carte banquaire ne correspond pas";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(5000).fadeOut(300);
                    });
                 </script>";
                 $success = false;
                $ver1 = false;
            }
            elseif($mot_de_passe != $_SESSION['user']->mot_de_passe)
            {
                $Error = "<span class='fa fa-warning'></span>  Le mot de passe saisie est incorrect";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(5000).fadeOut(300);
                    })
                 </script>";
                $success = false;
                $ver2 = false;
            }
            elseif($montant < $_SESSION['user']->solde)
            {
                $Error = "<span class='fa fa-warning'></span>  Vous ne pouvez pas demander un prêt en dessous de votre solde";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(5000).fadeOut(300);
                    })
                 </script>";
                $success = false;
            }
            elseif(!$ver1 && !$ver2)
            {
                $Error = "<span class='fa fa-warning'></span>  Le mot de passe et votre numéro de compte banquaire ne conconrdent pas";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(10000).fadeOut(300);
                    })
                 </script>";
            }
            if($success)
            {
                $solde_update = $_SESSION['user']->solde + $montant;
                $req = $db->prepare('UPDATE users SET solde = ? WHERE id = ?');
                $req->execute([$solde_update,$_SESSION['user']->id]);
                $_SESSION['user']->solde = $solde_update;
                $statement = $db->prepare('INSERT INTO pret (montant_du_pret,date_de_pret,rembourser,id_user) VALUES (?,?,?,?)');
                $statement->execute([$montant,date('Y-m-d H:i:s',strtotime('-1 hours')),"non",$_SESSION['user']->id]);
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                     <script>
                        $(function()
                        {
                            $('#sup_paysan').modal('show');
                            efface_formulaire();
                        });
                     </script>";
            }
        }
        include('view/users/demande_pret.php');
    }
function rembourser_pret()
{
    include('model/function.php');
        include('model/database.php');
        $montant = $num_banq = $mot_de_passe = $Error = "";
        if(isset($_POST['remb']))
        {
            $montant = $_POST['montant'];
            $num_banq = $_POST['num_cart'];
            $mot_de_passe = $_POST['password'];
            $success = true;
            $ver1 = true;
            $ver2 = true;
            if($num_banq != $_SESSION['user']->numero_compte_bancaire)
            {
                $Error = "<span class='fa fa-warning'></span> Votre numéro de carte banquaire ne correspond pas";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(5000).fadeOut(300);
                    });
                 </script>";
                 $success = false;
                $ver1 = false;
            }
            elseif($mot_de_passe != $_SESSION['user']->mot_de_passe)
            {
                $Error = "<span class='fa fa-warning'></span>  Le mot de passe saisie est incorrect";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(5000).fadeOut(300);
                    })
                 </script>";
                $success = false;
                $ver2 = false;
            }
            elseif(!$ver1 && !$ver2)
            {
                $Error = "<span class='fa fa-warning'></span>  Le mot de passe et votre numéro de compte banquaire ne conconrdent pas";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(10000).fadeOut(300);
                    })
                 </script>";
            }
            if($success)
            {
                $solde_update = $_SESSION['user']->solde - $montant;
                $req = $db->prepare('UPDATE users SET solde = ? WHERE id = ?');
                $req->execute([$solde_update,$_SESSION['user']->id]);
                $_SESSION['user']->solde = $solde_update;
                $statement = $db->prepare('UPDATE pret SET rembourser="oui",date_rembourser = ? WHERE id_user = ?');
                $statement->execute([date('Y-m-d H:i:s',strtotime('-1 hours')),$_SESSION['user']->id]);
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                     <script>
                        $(function()
                        {
                            $('#remb_effect').modal('show');
                            efface_formulaire();
                        });
                     </script>";
            }
        }
    include('view/users/rembourser_pret.php');
}
    function transactions()
    {
        include('model/database.php');
        $pays = "séléctionnez le pays"; $banque = "sélectionnez la banque"; $num_cart = $contacts = $montant = $Error = "";
        if(isset($_POST['transaction']))
        {
            $pays = $_POST['pays'];
            $banque = $_POST['banque'];
            $num_cart = $_POST['num_compt_bancaire'];
            $contacts = $_POST['contacts_beneficaire'];
            $montant = $_POST['montant_transfere'];
            $calcul = ($_SESSION['user']->solde*75)/100;
            $success = true;
            if($montant > $calcul)
            {
                $Error = "<span class='fa fa-warning'></span>  vous pouvez transféré au maximum que 75% de votre compte, soit <span style='font-weight:bolder'>".$calcul."</span> de Fcfa";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(10000).fadeOut(300);
                    })
                 </script>";
                 $success = false;
            }
            if($montant == 0)
            {
                $Error = "<span class='fa fa-warning'></span>  Vous ne pouvez pas transféré <span style='font-weight:bolder'>0</span> FCFA";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(10000).fadeOut(300);
                    })
                 </script>";
                $success = false;
            }
            elseif($montant < 10000)
            {
                $Error = "<span class='fa fa-warning'></span>  Le montant minium requis pour une transaction est de <span style='font-weight:bolder'>10000</span> Fcfa";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(10000).fadeOut(300);
                    })
                 </script>";
                $success = false;
            }
            if($success)
            {
                $solde_update = $_SESSION['user']->solde - $montant;
                $req = $db->prepare('UPDATE users SET solde = ? WHERE id = ?');
                $req->execute([$solde_update,$_SESSION['user']->id]);
                $_SESSION['user']->solde = $solde_update;
                $stat = $db->prepare('INSERT INTO transactions (Pays,Banque,Num_compte_ben,montant,contacts,date_du_transfert,id_user)  VALUES(?,?,?,?,?,?,?)');
                $stat->execute([$pays,$banque,$num_cart,$montant,$contacts,date('Y-m-d H:i:s'),$_SESSION['user']->id]);
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                     <script>
                        $(function()
                        {
                            $('#sup_paysan').modal('show');
                            efface_formulaire();
                        });
                     </script>";
            }
        }
        include('view/users/transactions.php');
    }
    function mytransactions()
    {
        include('model/function.php');
        include('model/database.php');
        $text = "";
        if(isset($_POST['supp_transat']))
        {
            $req = $db->prepare('DELETE FROM transactions WHERE id = ?');
            $req->execute([$_POST['id']]);
             $text = "<span class='fa fa-check-square-o'></span> transaction supprimé avec succès";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(3000).fadeOut(300);
                    })
                 </script>";
            
        }
        include('view/users/mytransactions.php');
    }
    function mycredits()
    {
        include('model/function.php');
        include('model/database.php');
        $text = "";
        if(isset($_POST['supp_reliquat']))
        {
            $req = $db->prepare('DELETE FROM pret WHERE id = ?');
            $req->execute([$_POST['id']]);
             $text = "<span class='fa fa-check-square-o'></span> reliquat supprimé avec succès";
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                 <script>
                    $(function()
                    {
                        $('#alert').fadeIn(300).delay(3000).fadeOut(300);
                    })
                 </script>";
            
        }
        include('view/users/mycredits.php');
    }
    function modifier_profil()
    {
        include('model/function.php');
        include('model/database.php');
        $Error ="";
        if(isset($_POST['modif_infos']))
        {
            $image = $_FILES['image']['name'];
            $imagePath = 'public/images/'.basename($image);
            $imageExtension= pathinfo($imagePath, PATHINFO_EXTENSION);
            $success = true;
            $isUploaded = true;
            if(empty($image))
            {
                $_SESSION['user']->email = $_POST['email'];
                $_SESSION['user']->contacts = $_POST['contacts'];
                $_SESSION['user']->numero_compte_bancaire = $_POST['num_cart'];
                $stat = $db->prepare('UPDATE users SET email= ?,numero_compte_bancaire = ?,contacts = ? WHERE id = ?');
                $stat->execute([$_POST['email'],$_POST['num_cart'],$_POST['contacts'],$_SESSION['user']->id]);
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                     <script>
                        $(function()
                        {
                            $('#sup_paysan').modal('show');
                        })
                     </script>";
            }
            else
            {
                if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif")
                {
                    $Error ="<span class='fa fa-warning'></span> les images autorisés sont jpeg , jpg , png et gif";
                    echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                     <script>
                        $(function()
                        {
                            $('#alert').fadeIn(300).delay(3000).fadeOut(300);
                        })
                     </script>";
                    $isUploaded = false;
                }
                if($isUploaded)
                {
                    if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
                    {
                        $Error ="<span class='fa fa-warning'></span> il y'a eu error lors du chargement de l'image";
                        echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                         <script>
                            $(function()
                            {
                                $('#alert').fadeIn(300).delay(3000).fadeOut(300);
                            })
                         </script>";
                        $success = false;
                        $isUploaded = false;
                    }
                }
                if($success && $isUploaded)
                {
                    $_SESSION['user']->image = $image;
                    $_SESSION['user']->email = $_POST['email'];
                    $_SESSION['user']->contacts = $_POST['contacts'];
                    $_SESSION['user']->numero_compte_bancaire = $_POST['num_cart'];
                    $stat = $db->prepare('UPDATE users SET image = ?,email= ?,numero_compte_bancaire = ?,contacts = ? WHERE id = ?');
                    $stat->execute([$image,$_POST['email'],$_POST['num_cart'],$_POST['contacts'],$_SESSION['user']->id]);
                    echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                         <script>
                            $(function()
                            {
                                $('#sup_paysan').modal('show');
                            })
                         </script>";
                }
            }
        }
        if(isset($_POST['modif_password']))
        {
            $password = getpassword();
            if($_POST['holdpw'] == $password->mot_de_passe) 
            {
                if($_POST['newpw'] == $_POST['confirmpw']) 
                {
                    updatepassword();
                    echo '<script src="public/bootstrap/js/jquery-3.3.1.min.js"></script>
                    <script>
                        $(function()
                        {
                            $("#sup_paysan").modal("show");
                        });
                    </script>';
                } 
                else 
                {
                    $Error = "<span class='fa fa-warning'>Error</span><br>Les mot de passe sont différents";
                    echo '<script src="public/bootstrap/js/jquery-3.3.1.min.js"></script>
                    <script>
                        $(function()
                        {
                            $("#alert").fadeIn(500).delay(2000).fadeOut(500);
                            $(".table2").click();
                        });
                    </script>';
                }

            }
            else 
            {
                $Error = "<span class='fa fa-warning'>Error</span><br>Mot de passe incorrect";
                    echo '<script src="public/bootstrap/js/jquery-3.3.1.min.js"></script>
                    <script>
                        $(function()
                        {
                            $("#alert").fadeIn(500).delay(2000).fadeOut(500);
                            $(".table2").click();
                        });
                    </script>';
            }
        }
        include('view/users/modifier_profil.php');
    }
    function deconnexion()
    {
        include('view/users/deconnexion.php');
    }

?>