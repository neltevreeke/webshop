<?php

session_start();

function create_user($method) {
    $db = mysqli_connect('mysql', 'root', 'sirsironenagros', 'registration');
    $login = $method['login'] ?? '';
    $passwd = $method['passwd'] ?? '';
    $passwd_2 = $method['rp-passwd'] ?? '';
    $submit = $method['submit'] ?? '';
    $errors = array();
    if (!$login || !$passwd || $submit !== "OK")
        array_push($errors, "Fill in all forms");
    if ($passwd_2 === $passwd){
        if ($login !== "" && $passwd !== "" && $submit === "OK") {
            $username = mysqli_real_escape_string($db, $_POST["login"]);
            $password = mysqli_real_escape_string($db, hash("whirlpool", $_POST["passwd"]));
            $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
            $result = mysqli_query($db, $user_check_query);
            $user = mysqli_fetch_assoc($result);
            if (!$user) {
                $query = "INSERT INTO users (username, password) VALUES('$username', '$password')";
                mysqli_query($db, $query);
                echo "User successfully created\n";
            } else if ($user) {
                array_push($errors, "User already exists");
            }
        }
    } else {
        array_push($errors, "Passwords do not match");
    }
    return ($errors);
}
?>

<html>
    <head>
        <title>Webshop - register</title>
        <link rel="stylesheet" type="text/css" href="./styles/stylesheet.css">
    </head>
    <body>
        <?php include("templates/navbar.php");?>
        <div class="register-form">
            <form action="register.php" method="post" name="register.php">
                Username: <br />
                <input type="text" name="login" value=""/>
                <br />
                Password: <br />
                 <input type="password" name="passwd" value=""/>
                <br />
                Repeat Password: <br />
                <input type="password" name="rp-passwd" value=""/>
                <br />
                <input type="submit" name="submit" value="OK"/>
                    <?php if ($_POST){
                    $errors = create_user($_POST);
                    if (count($errors) > 0)
                    {
                        foreach ($errors as $error){
                            echo "<div class=\"error\">$error</div>";
                        }
                    }
                    }?>
            </form>
        </div>
    </body>
</html>
