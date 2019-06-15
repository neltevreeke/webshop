<?php
session_start();

function login($method) {
    $db = mysqli_connect('mysql', 'root', 'sirsironenagros', 'registration');
    $login = mysqli_real_escape_string($db, $_POST["login"]);
    $passwd = mysqli_real_escape_string($db, hash("whirlpool", $_POST["passwd"]));
    $submit = $method['submit'] ?? '';
    $errors = array();
    $user_check_query = "SELECT * FROM users WHERE  username='$login' AND password='$passwd'";
    $result = mysqli_query($db, $user_check_query);
    if (!$login || !$passwd || $submit !== "OK")
        array_push($errors, "Fill in all forms");
    else if (mysqli_num_rows($result) == 0) {
        array_push($errors, "Wrong username or password");
    } else if (mysqli_num_rows($result) == 1) {
        $_SESSION["login"] = $login;
        header("Refresh:0");
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

        <div class="login-form">
            <form action="login.php" method="post" name="login.php">
                Username: <br />
                <input type="text" name="login" value=""/>
                <br />
                Password: <br />
                <input type="password" name="passwd" value=""/>
                <br />
                <input type="submit" name="submit" value="OK"/>
                <div class = "error">
                    <?php if ($_POST){
                    $errors = login($_POST);
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