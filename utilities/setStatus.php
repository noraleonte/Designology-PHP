<?php
include('../includes/autoload.php');
if (!empty($_POST['url']) && !empty($_POST['status'])) {
    $user = new Users();
    $thisUser = $user->getUserbyURL($_POST['url']);
    if ($thisUser) {
        $user->changeAccountStatus($thisUser['id'], $_POST['status']);
    }
}
