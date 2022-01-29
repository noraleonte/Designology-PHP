<?php
include('../includes/autoload.php');

if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    $user = new Users();
    if ($user->hasEmail($email)) {
        echo 1;
    } else {
        echo 0;
    }
}
