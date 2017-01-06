
<?php session_start(); include('testsC.php');?>
<?php include_once("custom_framework/Router.php");?>
<?php $router = new Router(); ?>

<!DOCTYPE html>

<header>
<link href="test.css" rel="stylesheet" media="all" type="text/css">
	<title>Ajouter un capteur</title>
    <h1>Chromotics</h1>
    <h2> Ajouter un capteur </h2>
    <h3>cette page permet d'activer les capteurs que vous avez commandes une fois ceux-ci receptionner </h3>
</header>


    <FRAMESET rows="25%,25%,50%"> 
    	on est 42 
	</FRAMESET>

    	<p>Reference du produit : <br> <input name="reference" type="text" placeholder="exemple: SDE4200"/></p>
    	<p>ID du capteur : <br> <input name="identifiant" type="text" placeholder="exemple: 100.23.12"/></p>
    	<p>Type de capteur : <br> 
    		<select name="typecapteur" >
    	<option> Temperature
    	<option> Humidite
    	<option> Luminosite
    	<option> Detecteur de mouvement
    		</select>
    	</p>

    <input type="submit" value="Activer">
 
