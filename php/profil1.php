<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');

$sesslogin = $_SESSION["login"];
$check = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = '$sesslogin'");
$check->execute(array($sesslogin));
$data = $check->fetch();
$rows = $check->rowCount();

if ($rows = 1) {
   echo $login;
}
if (isset($_POST['modifier'])) {

        $login10 = $_POST['login'];
        $password10 = $_POST['passwordChange'];
        $check = $bdd->prepare("UPDATE utilisateurs SET login='$login10',password='$password10' WHERE  login = '$sesslogin' ");
        $check->execute(array($login10));
        $data = $check->fetch();
        $rows = $check->rowCount();
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
                    <a href="accueiladmin.php">Accueil</a>
                </ul>
                <ul>
                    <a href="listeutilisateurs.php">Liste des utilisateurs</a>
                </ul>
                <ul>
                    <a href="profil.php">Mon Profil</a>
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
                <h1>Vous etes sur le point de modifier vos informations <?php echo $_SESSION["login"]; ?></h1>
                <form method="post" action="">
                    <h3 style="color: red;">
                        <? if ($data == true) {
                            echo  "vos information ont été modifier avec succès";
                        } else {
                            echo "veuillez réessayer vos modifications";
                        } ?></h3>
                    <form method="POST">
                        <table class="form-input">
                            <tr>
                            <tr>
                                <td>
                                    <label>Identifiant</label>
                                    <input type="text" name="login" value='<?php echo $login ?>' />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Ancien mot de passe</label>
                                    <input type="password" name="password" placeholder="Ancien mot de passe" minlength="8" required />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Nouveau mot de passe</label>
                                    <input type="password" name="passwordChange" placeholder="Nouveau mot de passe" required />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Confirmer mot de passe</label>
                                    <input type="password" name="verif" placeholder="Confirmer mot de passe" required />
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
    </main>
</body>

</html>