<?php
//config variables
$conf['valid_mail_domains']=["strathmore.edu","gmail.com","yahoo.com"];

//roles
define('ADMIN',1);
define('OWNER',2);
define('STAFF',3);
define('CAPTAIN',4);

//status
define('AVAILABLE',1);
define('UNAVAILABLE',2);
define('PENDING',3);
define('CONFIRMED',4);
define('CANCELLED',5);