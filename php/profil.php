<?php
session_start();
if (isset($_SESSION['login'])) {

    $login = $_SESSION['login'];

    if (isset($_POST['modifier'])) {

        try {

            $bdd = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');
        } catch (Exception $e) {
            // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : ' . $e->getMessage());
        }

        $newlogin = $_POST['newlogin'];
        $pass = $_POST['password'];
        $newpass = $_POST['newmdp'];
        $newpass2 = $_POST['newmdp2'];

        $check = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = '$login'");
        $check->execute(array($login));
        $data = $check->fetch();

        if (password_verify($pass, $data['password'])) {

            if ($newlogin && $newpass == $newpass2) {

                $newpassword = password_hash($newpass2, PASSWORD_BCRYPT);

                $check = $bdd->prepare("UPDATE utilisateurs SET login ='$newlogin',password ='$newpassword' WHERE login = '$login'");
                $check->execute(array("login" => $newlogin, "password" => $newpassword,));
                $data = $check->fetch();

                $_SESSION['login'] = $newlogin;

                echo "vos modifications ont bien été prise en compte";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title> Page inscription </title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="livre-or.css" />
</head>

<body>
    <header>
        <nav>
            <div>
                <h1>PAREDE</h1>
            </div>
            <div class="head">
                <ul>
                    <a href="accueiluser.php">Accueil</a>
                </ul>
                <ul>
                    <a href="espacepersonnel.php">Mon espace personnel</a>
                </ul>
                <ul>
                    <a href="profil.php">Mon Profil</a>
                </ul>
                <ul>
                    <a href="livre-or.php">Commentaires</a>
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
        <div align="center">
            <div>
                <h1 class="h1-">Vous etes sur le point de modifier vos informations <?php echo $_SESSION["login"]; ?></h1>
                <form class="form" method="POST">
                    <table class="form-inpute">
                        <tr>
                        <tr>
                            <td>
                                <label>Identifiant</label>
                                <input type="text" name="newlogin" id="newlogin" value="<?php echo $_SESSION['login']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Ancien mot de passe</label>
                                <input type="password" name="password" id="password" placeholder="Ancien mot de passe" minlength="8" required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Nouveau mot de passe</label>
                                <input type="password" name="newmdp" id="newmdp placeholder=" placeholder="Nouveau mot de passe" required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Confirmer mot de passe</label>
                                <input type="password" name="newmdp2" id="newmdp2 placeholder=" placeholder="Confirmer mot de passe" required />
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <button class="button" type="submit" name="modifier">Modifier</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer">
            <h1 class="foot fote">PAREDE</h1>
            <div class="foot">
                <div>
                    <a href="accueiluser.php">Accueil</a>
                </div>
                <div>
                    <a href="espacepersonnel.phps">Mon espace personnel</a>
                </div>
                <div>
                    <a href="profil.php"> Mon Profil</a>
                </div>
                <div>
                    <a href="livre-or.php">Commentaires</a>
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