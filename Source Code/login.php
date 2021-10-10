<?php include('./templates/header.php'); ?>
<link rel="stylesheet" href="./more/auth.css">
</head>

<body>
    <style>
        nav {
            max-width: 100vw;
        }

        .errors {
            max-width: 300px;
        }
    </style>
    <?php
    session_start();
    include('./config/functions.php');
    $error = ['email' => '', 'psw' => ''];
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    } else {
        $email = '';
    }
    if (isset($_POST['login'])) {
        if (empty($_POST['email'])) {
            $error['email'] = "Trebuie să introduci emailul pentru a te conecta!";
        } else {
            $email = $_POST['email'];
            $_SESSION['email'] = $email;
        }

        if (empty($_POST['password'])) {
            $error['psw'] = "Trebuie să introduci parola!";
        } else {
            $password = $_POST['password'];
        }

        if (array_filter($error)) {
        } else {
            $user = new Users();
            try {
                $verification = $user->verifyUser($email, $password);
                if ($verification == 2) {
                    $thisUser = $user->getUserbyEmail($email);
                    $_SESSION['user_id'] = $thisUser['id'];
                    $_SESSION['name'] = $thisUser['name'];
                    $_SESSION['userEmail'] = $thisUser['email'];
                    $_SESSION['userURL'] = $thisUser['url'];
                    $_SESSION['userCover'] = $thisUser['cover_image'];
                    $_SESSION['userProfile'] = $thisUser['profile_image'];
                    unset($_SESSION['email']);
                    header('Location: index.php');
                } else if ($verification == 0) {
                    $error['psw'] = "Ai introdus parola greșită!";
                } else if ($verification == 1) {
                    $error['psw'] = "Trebuie să activezi contul!";
                } else {
                    $error['email'] = "Acest cont a fost banat!";
                }
            } catch (exception $e) {
                $error['email'] = $e->getMessage();
            }
        }
    }

    ?>
    <div class="content">
        <div class="right_content" style="max-width:100vw;">
            <?php include('./templates/nav.php'); ?>

            <div class="horizontal">
                <div class="image">
                    <img src="./img/covers/login.png" alt="">
                </div>
                <div class="right_items">
                    <h2 class="left_text" style="margin-bottom: 8%;">Autentifică-te</h2>
                    <form action="login.php" method="post">
                        <div class="flex verticalflex">
                            <div class="flex">
                                <label for="email">Adresa de email</label>
                            </div>

                            <input type="email" name="email" placeholder="ex: creativul@domeniu.ro" value="<?php echo $email; ?>">
                            <div>
                                <p class=" errors"> <?php echo $error['email']; ?></p>
                            </div>
                            <div class="flex">
                                <label for="password">Parola</label>
                            </div>
                            <input type="password" name="password">
                            <div>
                                <p class="errors"> <?php echo $error['psw']; ?></p>
                            </div>
                            <input type="submit" value="Conectează-mă!" name="login" style="width: 300px;">
                            <a href="./signup.php">Nu ai încă un cont?</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bottom ">
                <a href="javascript:history.go(-1)">Du-mă înapoi</a>
                <a href="./activate.php">Activează un cont</a>
            </div>
            <?php include('./templates/footer.php'); ?>