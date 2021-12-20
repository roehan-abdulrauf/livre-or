<?php

session_start();
if(isset($_POST['submit'])){

    
    $sessionlogin = $_SESSION['login'];
    $com = $_POST['message'];
    $bdd = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');
    $check = $bdd->prepare("SELECT id FROM utilisateurs WHERE login = '$sessionlogin'");
    $check->execute(array());
    $data = $check->fetch();
    $id = $data[0][0]; #Recuperation de l'id
       


    #Insertion du commentaire 
    if(!empty($com)){
    
        $querycom = $bdd->prepare("INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES ('$com','$id',NOW())");
    
        $comment = 'Votre commentaire à bien été pris en compte';
    }
} 

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="livre-or.css" />
    <title>Livre-or</title>
</head>

<body>
    <header>
        <nav>
            <div>
                <h1>PAREDE</h1>
            </div>
            <div class="head">
                <ul>
                    <a href="espacepersonnel.php">Mon espace personnel</a>
                </ul>
                <ul>
                    <a href="livre-or.php">Commentaires</a>
                </ul>
                <ul>
                    <a href="commentaire.php">Ecrire un commentaire</a>
                </ul>
            </div>
            <div class="head">
                <ul>
                    <button class="buton"><a class="but" href="contact.php">Contact</a></button>
                </ul>
                <ul>
                    <button class="buton"><a class="but" href="deconnexion.php">Deconnexion</a></button>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <h1 class="h1-">Ecrivez votre avis</h1>
        <div align="center">
            <form class="form" action="" method="post">
                <table class="form-inpute">
                    <tr>
                        <td>
                            <label>Message :</label><br>
                            <input type="text" name="message" id="message" maxlength="80" placeholder="80 caractères maximum." style="margin: 0px; width: 405px; height: 68px;" required></textarea>
                        </td>
                    </tr>

                    <td align="center">
                        <button class="button" type="submit" name="submit">Envoyer</button>
                    </td>
                </table>
                <p>
        <?php if(isset($comment)){
            echo $comment;
        }
        ?>
    </p>
            </form>
        </div>
        </section>
    </main>
    <footer>
        <div class="footer">
            <h1 class="foot fote">PAREDE</h1>
            <div class="foot">
                <div>
                    <a href="espacepersonnel.phps">Mon espace personnel</a>
                </div>
                <div>
                    <a href="livre-or.php">Commentaires</a>
                </div>
                <div>
                    <a href="commentaire.php">Ecrire un commentaire</a>
                </div>
                <div>
                    <a href="contact.php">Contact</a>
                </div>
                <div>
                    <a href="deconnexion.php">Deconnexion</a>
                </div>
            </div>
            <div>
                <p class="foot copyright copy">Copyright©2021 Parede. Tous droits réservés.</p>
            </div>
    </footer>
</body>

</html>