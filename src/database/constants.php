<?php
//hosted db
define('DB_HOSTNAME', 'junction.proxy.rlwy.net');
define('DB_PORT', '24181');
define('DB_USER', 'root');
define('DB_PASS', 'VgqklvaWbwUcNZJkFXqoHDdSeIXnFwsk');
define('DB_NAME', 'railway');
//local db
define('DB_HOSTNAME_ALT', 'localhost');
define('DB_PORT_ALT', '3308');
define('DB_USER_ALT', 'root');
define('DB_PASS_ALT', '');
define('DB_NAME_ALT', 'railway');

//config variables
$conf['valid_mail_domains']=["strathmore.edu","gmail.com","yahoo.com"];

//roles
define('ADMIN',1);
define('OWNER',2);
define('STAFF',3);
define('CAPTAIN',4);