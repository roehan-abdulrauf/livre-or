<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');

$req = $bdd->query('SELECT * FROM utilisateurs');
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
                    <a href="admin.php">Accueil</a>
                </ul>
                <ul>
                    <a href="listeutilisateurs.php">Liste des utilisateurs</a>
                </ul>
                <ul>
                    <a href="#">Lien Github</a>
                </ul>
            </div>
            <div class="head">
                <ul>
                    <button class="buton"><a class="but" href="deconnexion.php">Deconnexion</a></button>
                </ul>
                <ul>
                    <button class="buton"><a class="but" href="contact.php">Contact</a></button>
                </ul>
            </div>
        </nav>
    </header>
    <main align="center">
        <div class="tarr">
            <h6> BIENVENUE SUR VOTRE TABLEAU DE BORD ADMIN</h6>
        </div>
        <table class="table">
            <thead class="border">
                <tr>
                    <th class="border th" scope="col">ID</th>
                    <th class="border th" scope="col">LOGIN</th>
                    <th class="border th" scope="col">PASSWORD</th>
                    <th class="border th" scope="col">SUPPRIMER</th>
                    <th class="border th" scope="col">MODIFIER</th>
                </tr>
            </thead>
            <tbody class="border">
                <?php
                while ($rows = $req->fetch()) {
                    echo "<tr><th>$rows[id]</th>";
                    echo "<th>$rows[login]</th>";
                    echo "<th>$rows[password]</th>";
                    echo "<th><a href=\"supprimerprofil.php?id=$rows[id]\">supprimer</a></th>";
                    echo "<th><a href=\"modifierprofil.php?id=$rows[id]\">modifier</a></th></tr>";
                }
                ?>
            </tbody>
        </table>
        <button class="button" type="submit" name="connexion"><a href="creeruser.php?id=<?php $rows['id'];?>\">Ajouter un utilisateur</a></button>
        </div>
    </main>
    <footer>
        <div class="footer">
            <h1 class="foot fote">PAREDE</h1>
            <div class="foot">
                <div>
                    <a href="admin.php">Accueil</a>
                </div>
                <div>
                    <a href="listeutilisateurs.phps">Liste des utilisateurs</a>
                </div>
                <div>
                    <a href="#">Lien Github</a>
                </div>
                <div>
                    <a href="deconnexion.php">Deconnexion</a>
                </div>
                <div>
                    <a href="contact.php">Contact</a>
                </div>
            </div>
            <div>
                <p class="foot copyright copy">Copyright©2021 Parede. Tous droits réservés.</p>
            </div>
    </footer>
</body>

</html>