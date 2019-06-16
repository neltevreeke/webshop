<?php
session_start();

function fetch_products() {
    $db = mysqli_connect('mysql', 'root', 'sirsironenagros', 'registration');
    $user_check_query = "SELECT * FROM products ORDER by id ASC";
    $result = mysqli_query($db, $user_check_query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($product = mysqli_fetch_assoc($result)) {
                print_r($products);
            }
        }
    }
}

?>

<html>
    <head>
        <title>Webshop - Shop</title>
        <link rel="stylesheet" type="text/css" href="./styles/stylesheet.css">
    </head>
    <body>
    <?php include("templates/navbar.php"); ?>
    <?php fetch_products(); ?>
    </body>
</html>
