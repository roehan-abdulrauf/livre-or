<?php
$db = mysqli_connect('localhost', 'root', '', 'livreor');
$query = mysqli_query($db, 'SELECT date, login, commentaire  FROM commentaires INNER JOIN utilisateurs ON id_utilisateur = utilisateurs.id ORDER BY date DESC ');
$all_result = mysqli_fetch_all($query);
//var_dump($resultat); 
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
    <main align="center">
        <h2>Liste des commentaires </h2>
        <section>
            <table>
                <thead>
                </thead>
                <tbody>
                    <?php
                    foreach ($all_result as $key => $comm) {
                        echo 'Posté le ' . $comm[0] . ' par ' . $comm[1] . ': ' . $comm[2] . '<br>' . '<br>';
                    }
                    ?>
                </tbody>
            </table>
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