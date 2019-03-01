<?php include('view/include/header.php'); ?>
            <div class="banner">
                <h2>bienvenue sur E-bank</h2>
            </div>
            <div class="big-content">
                <p>Chez e-bank, nous vous offrons deux services: le prêt et la transaction<br>Emprunter de l'argent chez e-bank est facile et sans frais,vous pouvez envoyer de l'argent dans différents pays et à toutes les banques quand vous vous le voulez,à quel heure vous le voulez et où vous le voulez</p>
                <div class="container">
                      <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-10 block">
                            <a href="index.php?r=pret">
                                <figure>
                                    <span class="fa fa-money"></span>
                                    <figcaption>contracter un prêt</figcaption>
                                </figure>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-10 block">
                             <a href="index.php?r=transactions">
                                <figure>
                                    <span class="fa fa-share"></span>
                                    <figcaption>transaction</figcaption>
                                </figure>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-10 block">
                             <a href="index.php?r=rembourser_pret">
                                <figure>
                                    <span class="fa fa-dollar"></span>
                                    <figcaption>Rembourser un prêt</figcaption>
                                </figure>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('view/include/footer.php'); ?>
        </div>
        <script src="public/bootstrap/js/jquery-3.3.1.min.js"></script>
        <script src="public/bootstrap/js/bootstrap.min.js"></script>
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