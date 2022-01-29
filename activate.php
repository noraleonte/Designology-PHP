<?php include('./templates/header.php'); ?>
<link rel="stylesheet" href="./more/auth.css">
</head>

<body>
    <style>
        .errors {
            max-width: 300px;
        }
    </style>
    <?php
    session_start();
    include('./config/functions.php');
    $error = ['code' => ''];
    if (isset($_POST['activate'])) {
        if (empty($_POST['code'])) {
            $error['code'] = "Trebuie să introduci codul de confirmare primit pe mail";
        } else {
            $insertedCode = $_POST['code'];
            $code = new Codes();
            $valid = $code->validateCode($insertedCode);
            if ($valid) {
                $user = new Users();
                $user->changeAccountStatus($valid, 2);
                header('Location: ./login.php');
            } else {
                $error['code'] = "Nu ai introdus codul bun...";
            }
        }
    }

    ?>
    <div class="content">
        <div class="right_content" style="max-width:100vw;">
            <?php include('./templates/nav.php'); ?>

            <div class="horizontal">
                <div class="image">
                    <img src="./img/covers/activate-01.png" alt="">
                </div>
                <div class="right_items">
                    <h2 class="left_text" style="margin-bottom: 8%;">Activează-ți contul</h2>
                    <form action="activate.php" method="post">
                        <div class="flex verticalflex">
                            <div class="flex">
                                <label for="confirmation code">Codul de confirmare primit</label>
                                <div class="tooltip">
                                    <svg width="13" height="13" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" fill="#8791c8" clip-rule="evenodd" d="M17 8.5C17 13.1944 13.1944 17 8.5 17C3.80558 17 0 13.1944 0 8.5C0 3.80558 3.80558 0 8.5 0C13.1944 0 17 3.80558 17 8.5ZM8 6.5V5H9V6.5H8ZM9 12V8H8V12H9Z" fill="#121923" />
                                    </svg>
                                    <p class="tooltiptext">Ți-am trimis pe email un cod de confirmare cu care trebuie să îți activezi contul.</p>
                                </div>
                            </div>

                            <input type="text" name="code" placeholder="">
                            <div>
                                <p class=" errors"> <?php echo $error['code']; ?></p>
                            </div>
                            <input type="submit" value="Activează!" name="activate" style="width: 300px;">
                            <a href="./signup.php">Nu ai încă un cont?</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bottom ">
                <a href="javascript:history.go(-1)">Du-mă înapoi</a>
                <a href="./login.php">Autentifică-mă</a>
            </div>
            <?php include('./templates/footer.php'); ?>