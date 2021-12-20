<!DOCTYPE html>
<html>

<head>
    <title> Page inscription </title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="livre-or.css" />
</head>

<body id="bodyform">
    <main>
        <h1 class="h-1">Compte PAREDE</h1>
        <div align="center">
            <form method="POST">
                <table class="form-input">
                    <tr>
                        <td>
                            <h1 class="h_1">Ajouter un utilisateur</h1>

                            <label>Identifiant</label>
                            <input type="text" name="login" placeholder="Entrer un identifiant" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Mot de passe</label>
                            <input type="password" name="password" placeholder="Entrer un mot de passe" minlength="8" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Confirmation mot de passe</label>
                            <input type="password" name="passwordverify" placeholder="Confirmer le mot de passe" required>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <button class="button" type="submit" name="inscription">Ajouter</button>
                        </td>
                    </tr>
                    <?php
                    session_start();
                    if (isset($_POST['inscription'])) {

                        $login =  htmlspecialchars($_POST['login']);
                        $password =  $_POST['password'];
                        $passwordverify = $_POST['passwordverify'];

                        $bdd = mysqli_connect('localhost', 'root', '', 'livreor');

                        if (!$bdd) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $check = "SELECT * FROM `utilisateurs` WHERE login = '$login'";

                        $result = mysqli_query($bdd, $check) or die("Connection failed: " . mysqli_connect_error());

                        $rows = mysqli_num_rows($result);

                        if ($rows == 0) {
                            if ($password ==  $passwordverify) {

                                $passwordhash = password_hash($password, PASSWORD_BCRYPT);

                                $insert = "INSERT INTO `utilisateurs` (login,password) VALUES ('$login','$passwordhash')";
                                mysqli_query($bdd, $insert);
                                // On redirige avec le message de succès
                                header("location:./listeutilisateurs.php");
                                echo ("Votre ajout a bien été envoyé.");
                            } elseif ($password !=  $passwordverify) {
                                echo '<h2 style="color:#E5DFDE ;">veuillez saisie les memes mot de passe.</h2>';
                            } else {
                                echo '<h2 style="color:#E5DFDE ;">Votre identifiant n\'est pas valide.</h2>';
                            }

                            mysqli_close($sql);
                        } else {
                            echo '<h2 style="color:#E5DFDE ;">Veuillez saisir un autre identifiant svp.</h2>';
                        }
                    }

                    ?>
                </table>
                <p><a class="connect-here" href="listeutilisateurs.php">Retourner sur la page admin</a></p>
            </form>
        </div>
    </main>
    <footer class="footeur">
        <div class="footer footter">
            <div>
                <p class="foot copyrighte copy">Copyright©2021 Cuisinella. Tous droits réservés.</p>
            </div>
    </footer>
</body>

</html>
