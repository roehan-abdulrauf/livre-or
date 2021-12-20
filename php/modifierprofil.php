<?php
session_start();
if (isset($_SESSION['login'])) {

    $userid = $_GET['id'];
    var_dump($_GET['id']);

    $bdd = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

    if (isset($_POST['modifier'])) {

        $newlogin = $_POST['newlogin'];
        $pass = $_POST['password'];
        $newpass = $_POST['newmdp'];
        $newpass2 = $_POST['newmdp2'];

        $check = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = '$userid'");
        $check->execute(array($userid));
        $data = $check->fetch();

        if (password_verify($pass, $data['password'])) {

            if ($newlogin && $newpass == $newpass2) {

                $req = $bdd->query("UPDATE utilisateurs SET login ='$newlogin',password ='$newpassword' WHERE id = '$userid'");
                $req->execute(array("login" => $newlogin, "password" => $newpassword,));
                header("Location: admin.php");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <div align="center">
            <div>
                <h1>Vous etes sur le point de modifier vos informations <? echo $userid; ?></h1>
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
                                    <input type="text" name="login" value='<? echo $userid ?>' />
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

</html>