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
//define('SS_ERROR_LOG', '/'.__DIR__ . '/silverstripe.log');

// You can set a specific TEMP_FOLDER
// Default silverstripe-cache is used, if available
//define('TEMP_FOLDER', __DIR__ . '/silverstripe-cache');

// On Development Environments all Emails can be directed to only one Email Adress
// Also you can specify the Form field
//define('SS_SEND_ALL_EMAILS_TO','');
//define('SS_SEND_ALL_EMAILS_FROM','');

// To be able to use opcode for manifest files define one of the following
//define('SS_MANIFESTCACHE', 'ManifestCache_File_PHP'); // on xcache installation, this might be faster
//define('SS_MANIFESTCACHE', 'ManifestCache_APC');

// if varnish stays in front and geoip is used, this variable will read the geolocation from x-forwarded-for
//define('GEOIP_SERVER_VAR', 'HTTP_X_FORWARDED_FOR');

// geoform needs a UDF (mysql user defined function) to be created
// either create this function manually or on each /dev/build
//define('GEOFORM_CREATE_GEODISTANCE_UDF', true);

// Self Defined Variables
// Admin Email Address (From)
define('ADMIN_EMAIL','__EMAIL__');
// Error Log Email Address
define('LOG_EMAIL','__EMAIL__');

// Default Destionation path after successfull login
define('DEFAULT_LOGIN_DESTINATION', 'cloud/index');

// Modules

// smtpmailer
define('SMTPMAILER_CHARSET_ENCODING','utf-8');
define('SMTPMAILER_SERVER_ADDRESS','smtp.gmail.com');
define('SMTPMAILER_SERVER_PORT','465');
define('SMTPMAILER_SECURE_CONNECTION','ssl'); // 'ssl', 'tls', ''
define('SMTPMAILER_DO_AUTHENTICATE',true); // true, false
define('SMTPMAILER_USERNAME','__EMAILADDRESS__');
define('SMTPMAILER_PASSWORD','__PASSWORD__');
define('SMTPMAILER_DEBUG_LEVEL',0);# Print debugging informations. 0 = no debuging, 1 = print errors, 2 = print errors and messages, 4 = print full activity
define('SMTPMAILER_LANGUAGE','de');# Language for messages. Look into code/vendor/language for available languages

global $_FILE_TO_URL_MAPPING;
$_FILE_TO_URL_MAPPING['__ABSOLUTEPATH__'] = 'http://__DOMAIN__';

// Session Extender
define('SESSIONID','PHPSESSID');
define('SESSIONLIFETIME',(60*60*2)); // two hours
// if redis should be used for Session Savepath
//define('SESSIONSAVEHANDLER', 'redis');
//define('SESSIONSAVEPATH', 'tcp://127.0.0.1:6379?prefix=mySessionPrefix');
// if memcached should be used for Session Savepath
//define('SESSIONSAVEHANDLER', 'memcached');
//define('SESSIONSAVEPATH', '127.0.0.1:11211');