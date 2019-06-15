<?php
function del_user($method) {
    echo "DELETEING\n";
    $db = mysqli_connect('mysql', 'root', 'sirsironenagros', 'registration');
    $login = mysqli_real_escape_string($db, $_POST["login"]);
    $passwd = mysqli_real_escape_string($db, hash("whirlpool", $_POST["passwd"]));
    $passwd_2 = mysqli_real_escape_string($db, hash("whirlpool", $_POST["passwd-2"]));
    $submit = $method['submit'] ?? '';
    $errors = array();
    $user_check_query = "SELECT * FROM users WHERE  username='$login' AND password='$passwd'";
    $result = mysqli_query($db, $user_check_query);
    if (!$login || !$passwd_2 || !$passwd || $submit !== "DEL") {
        array_push($errors, "Fill in all forms");
    } else if (mysqli_num_rows($result) == 0) {
        array_push($errors, "Wrong username or password");
    } else if ($passwd !== $passwd_2) {
        array_push($errors, "Passwords do not match");
    } else if (mysqli_num_rows($result) == 1 && $submit === "DEL") {
        $sql = "DELETE FROM users WHERE username='$login'";
        mysqli_query($db, $sql);
        // header("Location: logout.php");
    }
    return ($errors);
}
?>