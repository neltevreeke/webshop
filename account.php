<?php
session_start();

function modify($method) {
    $db = mysqli_connect('mysql', 'root', 'sirsironenagros', 'registration');
    $login = mysqli_real_escape_string($db, $_SESSION["login"]);
    $passwd = mysqli_real_escape_string($db, hash("whirlpool", $_POST["passwd"]));
    $new_passwd = mysqli_real_escape_string($db, hash("whirlpool", $_POST["new-passwd"]));
    $submit = $method['submit'] ?? '';
    $errors = array();
    $user_check_query = "SELECT * FROM users WHERE  username='$login' AND password='$passwd'";
    $result = mysqli_query($db, $user_check_query);
    if (!$new_passwd || !$passwd || $submit !== "OK")
        array_push($errors, "Fill in all forms");
    else if (mysqli_num_rows($result) == 0) {
        array_push($errors, "Incorrect password");
    } else if ($new_passwd === $passwd) {
        array_push($errors, "Passwords can't be the same");
    } else if (mysqli_num_rows($result) == 1 && $new_passwd !== $passwd) {
        mysqli_query($db, "UPDATE users SET password='$new_passwd' WHERE username='$login'");
    }
    return ($errors);
}
?>
<html>
    <head>
        <title>Webshop</title>
        <link rel="stylesheet" type="text/css" href="./styles/stylesheet.css">
    </head>
    <body>
        <?php include("./templates/navbar.php") ?>
        <div class="account-form">
            <?php 
                echo "Welcome back ".$_SESSION["login"]."<br /><br/>";
            ?>
            <form action="account.php" method="post" name="account.php">
                Old password: <br />
                <input type="password" name="passwd" value=""/>
                <br />
                New password: <br />
                <input type="password" name="new-passwd" value=""/>
                <br />
                <input type="submit" name="submit" value="OK"/>
                <div class = "error">
                    <?php if ($_POST){
                    $errors = modify($_POST);
                    if (count($errors) > 0)
                    {
                        foreach ($errors as $error){
                            echo "<div class=\"error\">$error</div>";
                        }
                    }
                    }?>
                </div>
            </form>
        </div>
    </body>
</html>