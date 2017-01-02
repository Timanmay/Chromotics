
<?php
session_start();
include('signinC.php');
?>
<!DOCTYPE html>
<html>
<header>
	<title>Connexion</title>
	<meta charset="utf-8" />
<link rel="stylesheet" href="../global/style.css" type="text/css">

</header>


<body>
	<div class="sign_in">
	<h1>Connexion</h1>
			<form action="signinView.php" method="post">
			Identifiant : <input type="text" name="login" placeholder="Tapez votre identifiant" /><br/>
			Mot de passe :<input type="text" name="password" placeholder="Tapez votre mot de passe"/><br/>
			<input type="submit"/><br/>
			<a href="#">Mot de passe oublié</a>
		</form>
		<?php 	if(isset($_POST['login']) && isset($_POST['password']) ){
			echo '<div class="error_msg">';
					authentification($_POST['login'],$_POST['password']);
			echo '</div>';
				}
		?>
	</div>





</body>	
</html>

