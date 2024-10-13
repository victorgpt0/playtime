<?php
require 'load.php';

session_destroy();

user::clearUser();

header("Location: index.php");

exit();