<?php
include('../includes/autoload.php');
session_start();
if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    $_SESSION['userEmail'] = $email;
    $user = new Users();
    try {
        $user->updateEmail($_SESSION['userURL'], $email);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
