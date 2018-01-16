<?php

global $project;
$project = 'app';
 
global $database;
 
// Use _ss_environment.php file for configuration
require_once("conf/ConfigureFromEnv.php");
        
Config::inst()->update('Email', 'admin_email', ADMIN_EMAIL);

Config::inst()->update('MySQLDatabase', 'connection_charset', 'utf8');

Config::inst()->update('GDBackend', 'default_quality', 100);

Controller::add_extension('AppControllerExtension');

Config::inst()->update('RootURLController', 'default_homepage_link', 'home');

Config::inst()->update('Security', 'default_login_dest', DEFAULT_LOGIN_DESTINATION);

// hash links will not be rewritten, to allow "Back to Top Button" and smooth scrolling on OnePagers
Config::inst()->update('SSViewer', 'rewrite_hash_links', false);
