<?php

session_start();
unset($_SESSION['role']);
unset($_SESSION['login']);
session_destroy();
header('location: login.php');
die()



?>