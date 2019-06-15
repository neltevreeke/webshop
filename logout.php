<?php
session_start();
unset($_SESSION["login"]);
header("Location: index.php");
?>

<html>
    <head>
        <title>Webshop</title>
        <link rel="stylesheet" type="text/css" href="./styles/stylesheet.css">
    </head>
    <body>
        <?php include("./templates/navbar.php") ?>
        <div>
            <p>You are now succesfully logged out.</p>
        </div>
    </body>
</html>