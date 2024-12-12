<?php
    function sanitize(string $text): string {
        return htmlspecialchars(trim($text));
    }

    $contactInfo = '';
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        // If no page is specified, the homepage is shown
        $page = $_GET['p'] ?? 'home';
    } else {
        $fullName = sanitize($_POST['full_name'] ?? '');
        $phoneNo = sanitize($_POST['phone_no'] ?? '');
        $email = sanitize($_POST['email'] ?? '');
        $persons = sanitize($_POST['persons'] ?? 0);
        $dateTime = sanitize($_POST['date_and_time'] ?? '');
        $information = sanitize($_POST['further_information'] ?? '');
        
        if ($fullName === '' || $phoneNo === '' || $email === '' ||
        $persons === 0 || $dateTime === '') {
            $page = 'contact';
        } else {            
            $contactInfo =<<<INFO
            --- REGISTRATION ---
            Full name: $fullName
            Phone no.: $phoneNo
            Email: $email
            Persons: $persons
            Date/time: $dateTime
            Further information: $information
            INFO;
            
            $success = file_put_contents(
                'registration/Contact Info ' . date('Y-m-d H-i-s') . '.txt', 
                $contactInfo
            );
            $page = 'home';
        }
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
        <?php if ($contactInfo !== ''): ?>
            <section id="registration">                    
                <?=($success ? 'Your contact information has been successfully registered' : 
                    'Unfortunately we could not register your information. Please call us by phone') ?>
            </section>
        <?php endif; ?>
        <?php
            switch ($page) {
                case 'menu': include_once('menu.htm'); break;
                case 'contact': include_once('contact.htm'); break;
                default: include_once('home.htm');
            }
        ?>
    </main>
    <footer>
        <p>&copy; 2024 KEA Development</p>
    </footer>
</body>
</html>