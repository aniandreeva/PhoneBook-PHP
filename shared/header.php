<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>PhoneBook</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<section class="hero">
    <header>
        <div class="wrapper">
            <a href="../index.php"><img src="img/logo.png" class="logo" alt="" title=""/></a>
            <nav>
                <ul>
                    <?php
                    if (isset($_SESSION["LoggedUserId"])) :
                        ?>
                        <?php
                        if ($_SESSION['LoggedUserIsAdmin']):
                            ?>
                            <li><a href="users.php">Users</a></li>
                            <?php
                        endif;
                        ?>
                        <li><a href="contacts.php">Contacts</a></li>
                        <li><a href="groups.php">Groups</a></li>
                        <li><a href="personal_edit.php">My account</a></li>
                        <li><a href="logout.php">Logout</a></li>

                        <?php
                    else:
                        ?>
                        <li><a href="register.php" class="login">Register</a></li>
                        <li><a href="login.php" class="login">Login</a></li>
                        <?php
                    endif;
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <?php
        if($_SERVER["PHP_SELF"] === "/phonebook/index.php") :
    ?>
    <section class="caption">

        <h2 class="caption">Hello <?= isset($_SESSION["LoggedUserId"]) ? $_SESSION['LoggedUserUsername'] : ""; ?></h2>

        <h3 class="properties">Welcome to your PhoneBook</h3>
    </section>
    <?php
        endif;
    ?>
</section>
