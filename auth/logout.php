<?php

const BASE_PATH = __DIR__ . '/';

require("../functions.php");
require("../database.php");


$_SESSION["user"] = null;
session_destroy();

$params = session_get_cookie_params();

setcookie(session_name(), '', time()-3600);

// header('location: /sample-php-project/auth/login.php');
header('location: /sample-php-project/home.php');
exit();


