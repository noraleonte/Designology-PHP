<?php include('./templates/header.php'); ?>
<link rel="stylesheet" href="./more/auth.css">
<script src="./js/auth.js"></script>


</head>

<body>
    <style>
        nav {
            max-width: 96vw;
        }

        .errors {
            max-width: 300px;
        }

        #myBtn {
            display: none;
        }
    </style>
    <?php

    include('./config/functions.php');
    include('./config/name.php');
    session_start();
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    } else {
        $email = '';
    }
    if (isset($_SESSION['password'])) {
        $password = $_SESSION['password'];
    } else {
        $password = '';
    }

    if (isset($_POST['signup'])) {
        if (empty($_POST['email'])) {
            // $errors['email'] = "Trebuie să introduci o adresă de email!";
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Trebuie să introduci un email valid!";
        } else {
            $email = $_POST['email'];
            $_SESSION['email'] = $email;
            $user = new Users();
            if ($user->hasEmail($email)) {
                $errors['email'] = "Există deja un cont cu acest email!";
            }
        }

        if (empty($_POST['password'])) {
            $errors['password'] = "Trebuie să introduci o parolă!";
        } else if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/', $_POST['password'])) {
            $errors['password'] = "Parola nu îndeplinește condițiile!";
        } else {
            $password = $_POST['password'];
            $_SESSION['password'] = $password;
        }
        if (empty($_POST['passwordRepeat'])) {
            $errors['confirm'] = "Trebuie să introduci o parolă!";
        } else if ($_POST['passwordRepeat'] != $_POST['password']) {
            $errors['confirm'] = "Parola nu îndeplinește condițiile!";
        } else {
            $confirm = $_POST['passwordRepeat'];
        }
        if (array_filter($errors)) {
        } else { ?>
            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <svg id="close" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.6569 12.6569L1.34316 1.34315" stroke="#808080" stroke-width="2" stroke-linecap="round" />
                        <path d="M12.6568 1.34315L1.34314 12.6569" stroke="#808080" stroke-width="2" stroke-linecap="round" />
                    </svg>

                    <h2 class="left_text">Sunt corecte aceste date?</h2>
                    <p class="userData"><?php echo $email; ?></p>
                    <div class="flex" style="justify-content: space-between; align-items:flex-end">
                        <button id="nope" class="red">Nu, nu sunt</button>
                        <button id="go">Da, sunt corecte</button>
                    </div>
                </div>

            </div>
    <?php }
    }



    ?>
    <div class="content">
        <div class="right_content" style="max-width:100vw;">
            <?php include('./templates/nav.php'); ?>

            <div class="horizontal">
                <div class="image">
                    <img src="./img/covers/signup.png" alt="">
                </div>
                <div class="right_items">
                    <h2 class="left_text" style="margin-bottom: 8%;">Înregistrează-te</h2>

                    <div class="flex verticalflex">
                        <div class="flex">
                            <label for="email">Adresa de email</label>
                            <div class="tooltip">
                                <svg width="13" height="13" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" fill="#8791c8" clip-rule="evenodd" d="M17 8.5C17 13.1944 13.1944 17 8.5 17C3.80558 17 0 13.1944 0 8.5C0 3.80558 3.80558 0 8.5 0C13.1944 0 17 3.80558 17 8.5ZM8 6.5V5H9V6.5H8ZM9 12V8H8V12H9Z" fill="#121923" />
                                </svg>
                                <p class="tooltiptext">Avem nevoie de emailul tău ca să îți putem confirma identitatea. Alți utilizatori nu vor avea niciodată acces la emailul tău.</p>
                            </div>
                        </div>

                        <input type="text" name="email" placeholder="ex: creativul@domeniu.ro" value="<?php echo $email; ?>" id="email">

                        <!-- //password -->
                        <div>
                            <div class="flex">

                                <label for="password">Parolă</label>
                                <div class="tooltip">
                                    <svg width="13" height="13" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" fill="#8791c8" clip-rule="evenodd" d="M17 8.5C17 13.1944 13.1944 17 8.5 17C3.80558 17 0 13.1944 0 8.5C0 3.80558 3.80558 0 8.5 0C13.1944 0 17 3.80558 17 8.5ZM8 6.5V5H9V6.5H8ZM9 12V8H8V12H9Z" fill="#121923" />
                                    </svg>
                                    <p class="tooltiptext">Trebuie să setezi o parolă ca să îți putem securiza contul. Va trebui să reții perola ca să te poți autentifica din nou în cont.</p>
                                </div>
                            </div>
                            <input type="password" name="password" id="psw">

                            <div class="message">
                                <p class="invalid" id="capital">O <strong>literă mare</strong></p>
                                <p class="invalid" id="letter">O <strong>literă mică</strong></p>
                                <p class="invalid" id="number">Un <strong>număr</strong></p>
                                <p class="invalid" id="length">Cel puțin <strong>8 caractere</strong></p>
                            </div>
                        </div>
                        <!-- password confirm -->
                        <div>
                            <div class="flex">

                                <label for="password confirmation">Confirmare parolă</label>
                                <div class="tooltip">
                                    <svg width="13" height="13" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" fill="#8791c8" clip-rule="evenodd" d="M17 8.5C17 13.1944 13.1944 17 8.5 17C3.80558 17 0 13.1944 0 8.5C0 3.80558 3.80558 0 8.5 0C13.1944 0 17 3.80558 17 8.5ZM8 6.5V5H9V6.5H8ZM9 12V8H8V12H9Z" fill="#121923" />
                                    </svg>
                                    <p class="tooltiptext">Trebuie să ne asigurăm că ai introdus parola corectă. Dacă setezi o parolă greșită, nu vei mai putea recupera contul.</p>
                                </div>
                            </div>
                            <input type="password" name="passwordRepeat" id="repeat">
                            <div class="message">
                                <p class="invalid" id="confirm">Parolele nu se potrivesc!</p>
                                <p class="valid hidden" id="confirm2">Parolele se potrivesc!</p>
                            </div>

                        </div>
                        <button style="width: 300px;" id="signup">Să începem!</button>
                        <a href="./login.php">Ai deja un cont?</a>
                    </div>

                </div>
            </div>
            <div class="bottom">
                <a href="javascript:history.go(-1)">Du-mă înapoi</a>
                <a href="./activate.php">Activează un cont</a>
            </div>
            <button id="myBtn"></button>

            <?php include('./templates/footer.php'); ?>