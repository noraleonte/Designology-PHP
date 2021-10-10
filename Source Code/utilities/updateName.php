<?php
include('../includes/autoload.php');
include('../config/name.php');
include('../config/functions.php');

session_start();

function changeName()
{
    $name = generateName();
    $user = new Users();
    while ($user->hasName($name)) {
        $name = generateName();
    }
    try {
        $user->updateName($_SESSION['userEmail'], $name);
        $_SESSION['name'] = $name;
        return $name;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
echo changeName();
