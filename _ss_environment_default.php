<?php

/**
 * Default Environment File
 * altenate to your local needs and remove _default from filename
 * 
 * see http://doc.silverstripe.org/framework/en/topics/environment-management
 */

/* Database connection */
define('SS_DATABASE_CLASS', 'MySQLPDODatabase');
define('SS_DATABASE_SERVER', 'localhost');
define('SS_DATABASE_USERNAME', '__USERNAME__');
define('SS_DATABASE_PASSWORD', '__PASSWORD__');
define('SS_DATABASE_NAME', '__DATABASE__');


/* What kind of environment is this: dev, test, or live (ie, production)? */
define('SS_ENVIRONMENT_TYPE', 'live');

// These two defines sets a default login which, when used, will always log
// you in as an admin, even creating one if none exist.
define('SS_DEFAULT_ADMIN_USERNAME', '__ADMIN__');
define('SS_DEFAULT_ADMIN_PASSWORD', '__PASSWORD__');
 
// This causes errors to be written to the silverstripe.log file in the same directory as this file, so /var.
// Before PHP 5.3.0, you'll need to use dirname(__FILE__) instead of __DIR__
define('SS_ERROR_LOG', '/'.__DIR__ . '/silverstripe.log');

// Self Defined Variables
// Admin Email Address (From)
define('ADMIN_EMAIL','__EMAIL__');

// Default Destionation path after successfull login
define('DEFAULT_LOGIN_DESTINATION', 'cloud/index');

global $_FILE_TO_URL_MAPPING;
$_FILE_TO_URL_MAPPING['__ABSOLUTEPATH__'] = 'http://__DOMAIN__';
