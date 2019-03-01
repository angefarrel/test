<?php
    function getUser($num,$mdp)
     {
        include 'model/database.php';
         $user1 = $db->prepare('SELECT * FROM users WHERE numero_compte_bancaire = ? AND mot_de_passe = ?');
         $user1->execute([$num,$mdp]);
         $user = $user1->fetch(PDO::FETCH_OBJ);
         if($user)
            {
                return $user;
            }
            else
            {
                echo "<script src='public/bootstrap/js/jquery-3.3.1.min.js'></script>
                <script>
                   $(function()
                   {
                       $('#error').fadeIn(300).delay(10000).fadeOut(300);
                    });
               </script>"; 
            }

    } 
    function getpassword()
    {
        include('model/database.php');
        $statement = $db->prepare('SELECT mot_de_passe FROM users WHERE id = ?');
        $statement->execute([$_SESSION['user']->id]);
        $row = $statement->fetch(PDO::FETCH_OBJ);
        if($row)
        {
            $user = $row;
            return $user;
        }
    }
    function updatepassword()
    {
        include('model/database.php');
        $statement = $db->prepare('UPDATE users SET mot_de_passe = ? WHERE id = ?');
        $statement->execute([$_POST['confirmpw'],$_SESSION['user']->id]);
    }
?>