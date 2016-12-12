<?php include_once("custom_framework/Router.php");?>
<?php $router = new Router(); ?>
<header>
    <h1>Chromotics</h1>


    <div>
        <li>
            <ul><a href="<?php echo $router->createUrl("connection");?> ">Accueil</a></ul>
            <ul><a href="<?php echo $router->createUrl("contact");?> ">Nous Contacter</a></ul>
        </li>
    </div>

    
</header>