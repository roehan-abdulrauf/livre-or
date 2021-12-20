<?php
session_start();

    $bdd = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');
    
    $userid = $_GET['id'];
    var_dump($_SESSION);

    $req = $bdd->query("DELETE FROM utilisateurs where id = '$userid'");
    $req->execute(array());
    $rows = $req->fetch();
    header("Location: listeutilisateurs.php");

?>