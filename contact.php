<?php
$user = "root";
$password = "";
$database = "uga";
$host = "localhost";

$con = new mysqli($host,$user,$password,$database);
if ($con->connect_error) {
    die("connexion échouée : " .$con->connect_error);
}
    //Récupération des données du formulaire

    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    //Enregistrement des données dans la base de donneé

    $sql = "INSERT INTO contacts(nom,telephone,email) VALUES('$nom', '$telephone', '$email')";

    $con->close();

?>