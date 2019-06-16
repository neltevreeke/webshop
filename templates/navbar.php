<div class="navbar">
    <div class="logo"><a href="/index.php">Webshop</a></div>
    <div class="menu">
        <ul>
            <li><a href="shop.php">Shop</a></li>
            <?php 
                if (!array_key_exists("login", $_SESSION)) {
                    echo "<li><a href= \"/register.php\">Register</a></li>";
                    echo "<li><a href=\"/login.php\">Log in</a></li>";
                }
                if (array_key_exists("login", $_SESSION)) {
                    echo "<li><a href=\"/account.php\">Account Details</a></li>";
                    echo "<li><a href=\"/logout.php\">Log out ".$_SESSION['login']."</a></li>";
                }
            ?>
            <li><a href="#">Cart</a></li>
        </ul>
    </div>
</div>