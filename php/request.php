<?php
// Connect to database
include ("db_connect.php");
$request_method = $_SERVER["REQUEST_METHOD"];
function getComments(){
    global $mysqli;
    $query = "SELECT * FROM commentaire INNER JOIN stylo ON commentaire.idStylo=stylo.idStylo INNER JOIN utilisateur ON commentaire.idUtilisateur=utilisateur.idUtilisateur INNER JOIN styloerreur ON commentaire.idStylo=styloerreur.idStylo INNER JOIN erreur ON styloerreur.idErrreur= erreur.idErreur";
    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_assoc($result);
    return $row;
}
?>