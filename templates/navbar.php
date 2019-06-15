<div class="navbar">
    <div class="logo"><a href="/rush00/index.php">Webshop</a></div>
    <div class="menu">
        <ul>
            <li><a href="#">Shop</a></li>
            <?php 
                if (!array_key_exists("login", $_SESSION)) {
                    echo "<li><a href= \"/rush00/register.php\">Register</a></li>";
                    echo "<li><a href=\"/rush00/login.php\">Log in</a></li>";
                }
                if (array_key_exists("login", $_SESSION)) {
                    echo "<li><a href=\"/rush00/account.php\">Account Details</a></li>";
                    echo "<li><a href=\"/rush00/logout.php\">Log out ".$_SESSION['login']."</a></li>";
                }
            ?>
            <li><a href="#">Cart</a></li>
        </ul>
    </div>
</div>