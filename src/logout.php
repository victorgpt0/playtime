<?php
require 'load.php';

user::clearUser();

session_destroy();

header("Location: index.php");

exit();