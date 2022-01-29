<?php
include('../includes/autoload.php');
include('../config/name.php');
include('../config/functions.php');

if (!empty($_POST['email']) && !empty($_POST['psw'])) {
    $email = $_POST['email'];
    $password = $_POST['psw'];

    try {
        $user = new Users();
        $name = generateName();
        while ($user->hasName($name)) {
            $name = generateName();
        }
        $url = convertURL($name);
        $user->setUsers($email, $password, $name, $url);
        $newUser = $user->getUserIdbyEmail($email);
        echo $newUser;
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
}
