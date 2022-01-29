<?php
include('../includes/autoload.php');

if (!empty($_POST['code']) && !empty($_POST['user'])) {
    $user = $_POST['user'];
    $generatedCode = $_POST['code'];
    $code = new Codes();
    try {
        $code->setCode($user, $generatedCode);
    } catch (Exception $e) {
    }
}
