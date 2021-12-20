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
                            <h1 class="h_1">Connectez-vous à votre<br> compte Parede</h1>
                            <label>Identifiant</label>
                            <input type="text" name="login" placeholder="Entrer un identifiant" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Mot de passe</label>
                            <input type="password" name="password" placeholder="Entrer un mot de passe" required>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <button class="button" type="submit" name="connexion">Me connecter</button>
                        </td>
                    </tr>
                    <?php
                    session_start();
                    if (isset($_POST['connexion'])) {
                        if (!empty($_POST['login']) && !empty($_POST['password'])) {


                            $bdd = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');

                            // Création de variable pour chaque données avec sécu
                            $login = htmlspecialchars($_POST['login']);
                            $password = htmlspecialchars($_POST['password']);

                            $check = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = '$login'");
                            $check->execute(array($login));
                            $data = $check->fetch();
                            $rows = $check->rowCount();
                            $verify = password_verify($password, $data['password']);
                            if ($rows == 1) {
                                if ($login == $data['login'] && $verify) {

                                    $_SESSION['login'] = $data['login'];
                                    
                                    header("Location: espacepersonnel.php");
                                } elseif ($login == "admin" &&  $password == "admin") {
                                    header("Location: listeutilisateurs.php");
                                } else {
                                    echo '<h3 style="color:#E5DFDE ;">Le nom d\'utilisateur ou le mot de passe est incorrect.</h3>';
                                }
                            } else {
                                echo '<h3 style="color:#E5DFDE ;">Le nom d\'utilisateur ou le mot de passe est incorrect.</h3>';
                            }
                        }
                    }
                    ?>
                </table>

                <p>Pour nous rejoindre. <a class="connect-here" href="inscription.php">Créer un compte</a></p>
            </form>
        </div>
    </main>
    <footer class="footeur">
        <div class="footer footter">
            <div>
                <p class="foot copyrighte copy">Copyright©2021 Parede. Tous droits réservés.</p>
            </div>
    </footer>
</body>

</html>