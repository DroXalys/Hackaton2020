<?php
include ("db_connect.php");
$auth = false;

if (isset($_POST['PHP_AUTH_USER']) && isset($_POST['PHP_AUTH_PW'])) {
  
 
  // construction de la requète
  $user=$_POST['PHP_AUTH_USER'];
  $mdp=md5($_POST['PHP_AUTH_PW']);

	
  $req  = "select * from utilisateur where mail = '".$user."' ";

  $res = mysqli_query($mysqli,$req) or die("Impossible d'exécuter la requête");
  $nb = mysqli_num_rows($res);

  if ($nb != 0) {
	
      // On a trouvé une ligne, on encode maintenant le mot de passe fourni
      // par l'utilisateur et on le compare avec celui retourné par mySQL
	  $row = mysqli_fetch_assoc($res);
      $user_passwd = $row['mdp_crypte'];


      if($user_passwd === $mdp) 
	    {$auth = true;
		}
		
	
  }
}
if (!$auth) {
	header ("location: akinator.php");
}

if ($auth) {
	
  session_start();
  session_unset();
  $_SESSION['chk_pwd_admin']="ok";
   $_SESSION['id_user']= $row[id];
   
		
   // echo $_SESSION['chk_pwd_admin'];
//echo "test";

   header ("location: présentation.php");

}

?>