<?php
include('../includes/autoload.php');
session_start();
if (!empty($_POST['cl'])) {
    $cl = $_POST['cl'];
    $_SESSION['userCover'] = $cl;
    $user = new Users();
    try {
        $user->addCover($_SESSION['userURL'], $cl);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
if (!empty($_POST['profile'])) {
    $profile = $_POST['profile'];
    $_SESSION['userProfile'] = $profile;
    $user = new Users();
    try {
        $user->addProfile($_SESSION['userURL'], $profile);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
