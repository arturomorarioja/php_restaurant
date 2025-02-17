<?php

require_once 'src/registration.php';

$registration = false;
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // If no page is specified, the homepage is shown
    $page = $_GET['p'] ?? 'home';
} else {
    $registration = true;
    $success = registerContact($_POST);
    $page = $success ? 'home' : 'contact';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Restaurant KEA</title>
    <link rel="stylesheet" href="css/<?=$page ?>.css">
</head>
<body>
    <header>
        <h1>Restaurant KEA</h1>
    </header>
    <nav>
        <ul>
            <li>
                <a href="index.php?p=home" id="home" 
                    <?=($page == 'home' ? 'class="selected"' : '') ?>>Home</a>
            </li>
            <li>
                <a href="index.php?p=menu" id="menu" 
                    <?=($page == 'menu' ? 'class="selected"' : '') ?>>Menu</a>
            </li>
            <li>
                <a href="index.php?p=contact" id="contact" 
                    <?=($page == 'contact' ? 'class="selected"' : '') ?>>Contact</a>
            </li>
        </ul>
    </nav>
    <main>
        <?php if ($registration): ?>
            <section id="registration">                    
                <?=($success ? 'Your contact information has been successfully registered' : 
                    'Unfortunately we could not register your information. Please call us by phone') ?>
            </section>
        <?php endif; ?>
        <?php
            switch ($page) {
                case 'menu': include_once 'views/menu.htm'; break;
                case 'contact': include_once 'views/contact.htm'; break;
                default: include_once 'views/home.htm';
            }
        ?>
    </main>
    <footer>
        <p>&copy; 2025 KEA Development</p>
    </footer>
</body>
</html>