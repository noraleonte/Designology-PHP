<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['userEmail']);
unset($_SESSION['userURL']);
header('Location: index.php');
