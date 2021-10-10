<?php
include('../includes/autoload.php');
if (!empty($_POST['url'])) {
    $user = new Users();
    $thisUser = $user->getUserbyURL($_POST['url']);
    if ($thisUser) {
        echo $thisUser['status'];
    }
}
