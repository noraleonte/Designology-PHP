<?php
include('../includes/autoload.php');
session_start();
if (!empty($_POST['reward_id'])) {
    $reward = new Rewards();
    if ($_POST['type'] == 2) {
        $reward->setSelectedBadge($_POST['reward_id'], $_SESSION['user_id']);
    } else {
        $reward->setSelectedTitle($_POST['reward_id'], $_SESSION['user_id']);
    }
    echo "am reusit";
}
