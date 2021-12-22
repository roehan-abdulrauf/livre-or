<!DOCTYPE html>
<html>

<head>
    <title> Page inscription </title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../livre-or.css" />
</head>

<body id="bodyform">
    <main>
        <h1 class="h-1">Compte PAREDE</h1>
        <div align="center">
            <form method="POST">
                <table class="form-input">
                    <tr>
                        <td>
                            <h1 class="h_1">Créer votre compte<br>Parede</h1>
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
                            <button class="button" type="submit" name="inscription">M'inscrire</button>
                        </td>
                    </tr>
                    <?php
                    session_start();
                    $bdd = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');

                    if (isset($_POST['inscription'])) {
                        if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['passwordverify'])) {

                            // Création de variable pour chaque données avec sécu
                            $login = htmlspecialchars($_POST['login']);;
                            $password = htmlspecialchars($_POST['password']);
                            $passwordverify = htmlspecialchars($_POST['passwordverify']);


                            $check = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = '$login'");
                            $check->execute(array($login));
                            $data = $check->fetch();
                            $rows = $check->rowCount();

                            if ($rows == 0) {
                                if (strlen($login) <= 100) {
                                    if ($password === $passwordverify) {

                                        $password = password_hash($password, PASSWORD_BCRYPT);


                                        // On insère dans la base de données
                                        $insert = $bdd->prepare('INSERT INTO utilisateurs (login,password) VALUES(:login,:password)');
                                        $insert->execute(array(
                                            'login'    => $login,
                                            'password' => $password,
                                        ));
                                        // On redirige avec le message de succès
                                        echo ("Votre ajout a bien été envoyé.<br>.<br>Vous êtes ajouté dans la DB des Users");
                                        header('Location:connexion.php');
                                        die();
                                    } elseif ($password !=  $passwordverify) {
                                        echo '<h2 style="color:#E5DFDE ;">veuillez saisie les memes mot de passe.</h2>';
                                    } else {
                                        echo '<h2 style="color:#E5DFDE ;">Votre identifiant n\'est pas valide.</h2>';
                                    }
                                }
                            } else {
                                echo '<h2 style="color:#E5DFDE ;">Veuillez saisir un autre identifiant svp.</h2>';
                            }
                        }
                    }
                    ?>
                </table>

                <p>Déjà inscrit? <a class="connect-here" href="connexion.php">Connectez-vous ici</a></p>
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