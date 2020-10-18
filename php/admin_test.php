<?php
include ("db_connect.php");
$auth = false;

if (isset($_POST['PHP_AUTH_USER']) && isset($_POST['PHP_AUTH_PW'])) {
    $user = $_POST['PHP_AUTH_USER'];
    $mdp = md5($_POST['PHP_AUTH_PW']);

    // Construction de la requète
    $req  = "select * from utilisateur where mail = '".$user."' ";
    $res = mysqli_query($mysqli,$req) or die("Impossible d'exécuter la requête");
    $nb = mysqli_num_rows($res);
    if ($nb != 0) {
        // On a trouvé une ligne, on encode maintenant le mot de passe fourni
        // par l'utilisateur et on le compare avec celui retourné par mySQL
        $row = mysqli_fetch_assoc($res);
        $user_passwd = $row['mdp_crypte'];
        $user_passwd = md5($user_passwd);
        $user_type = $row['typeUtilisateur'];
        $user_name = $row['nom'];
        $user_last_name = $row['prenom'];
        if (($user_passwd === $mdp) ) {
            // && ($user_type == 'admin')
            $auth = true;
        } 
    }
}
if (!$auth) {
    header ("location: login.php");
}
if ($auth) {
    var_dump('Connected');
    session_start();
    session_unset();
    $_SESSION['chk_pwd_admin']="ok";
    $_SESSION['id_user']= $row['idUtilisateur'];
    $_SESSION['mail']=$row['mail'];
    $_SESSION['pays']=$row['pays'];
    $_SESSION['nom']=$user_name;
    $_SESSION['prenom']=$user_last_name;
    header ("location: comment.php");
}  
?>