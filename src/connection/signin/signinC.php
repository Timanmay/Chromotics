<?php
function authentification($login,$mdp){

	$bdd = new PDO('mysql:host=localhost;dbname=mydb;charset=utf8', 'root', '');
	$req = $bdd->prepare("SELECT * FROM utilisateur WHERE email =:login");
	$req->execute(array(':login'=>$login));
	 while($data = $req->fetch()){
	 	$password = $data['mdp'];
	 	if($password == $mdp){
				 $_SESSION['id_user'] = $data['id'];
	 
				 header('Location: ../home/homeView.php');
				 return 1;//on sort de la fonction
	 	}

	 }
	 echo 'Echec de connexion.';

}










 
?>