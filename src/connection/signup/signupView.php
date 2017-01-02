
<?php
session_start();
var_dump($_POST);
include('signupC.php');
?>
<!DOCTYPE html>
<html>
<header>
	<title>Créer un compte</title>
	<meta charset="utf-8" />
<link rel="stylesheet" href="../global/style.css" type="text/css">

</header>


<body>
	<div class="sign_up">
	<h1>Inscription</h1>
		
		<form action="signupView.php" method="post">
			
				<div class="step">Etape 1 : informations personnelles</div>
				<label class="labelSignUp">Nom </label> <input type="text" name="nom" placeholder="Tapez votre nom"/><br/>
				<label class="labelSignUp">Prenom </label> <input type="text" name="prenom" placeholder="Tapez votre prenom"/><br/>
				<label class="labelSignUp">Adresse</label> <textarea name="adresse" placeholder="Tapez votre adresse"></textarea><br/>
				<label class="labelSignUp">Mail </label><input type="email" name="mail" placeholder="Tapez votre adresse mail" /><br/>
				<label class="labelSignUp">Mot de passe </label><input type="password" name="password" placeholder="Tapez votre mot de passe"/><br/>
		


			
				<div class="step" >Etape 2 : valider le compte avec le produit fourni</div>
					<label class="labelSignUp">Réference </label> <input type="text" name="ref"/><br/>
					<label class="labelSignUp">Objet </label> <select name="is_ca">
																	<option value="CeMac"> CeMac </option>
																	<option value="1"> Capteur</option>
																	<option value="0">Actionneur</option>

																</select></br>
					<label class="labelSignUp">Type </label> <?php type();?>
			

			<input type="submit" name="SignUp"/><br/>
			
		</form>


		<?php if(isset($_POST['SignUp'])){
			$SignUp = new SignUp($_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['password'],$_POST['adresse'],$_POST['ref'],$_POST['is_ca'],$_POST['is_ca'],$_POST['service']);
			$SignUp->ajout_membre_verification();


			}

			?>

	</div>





</body>	
</html>

