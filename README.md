# Vagrant Proxy - (c) Andre Lohmann 2018

## Maintainer Contact 
 * Andre Lohmann
   <lohmann.andre (at) gmail (dot) com>
	
## Requirements
Requirements are handled by composer
 

## Overview
this Project provides a software tool, to build your own selfhosted vargant proxy in case you are behind a company proxy that delivers self signed man-in-the-middle certificates, that let vagrant fail

## Installation

### Github

 * clone the project
 * copy _ss_enviroment_default.php to _ss_environment
 * fill in the necessary configurations in _ss_enviroment.php (DB, SMTP credentials, ...)
 * copy htaccess_default to .htaccess
 * set RewriteBase, if application will not run under www-root
 * create apache vHost (example can be found at the bottom of this readme)
 * do a "composer install" to resolve all requirements
```
composer install
```

### Apache 2.4 vHost Example:

```
<VirtualHost *:80>
    ServerName YOURDOMAIN
    ErrorLog /var/log/apache2/error-YOURPROJECT
    LogLevel notice
    RedirectMatch permanent ^/(.*) http://www.YOURDOMAIN/$1
</VirtualHost>

<VirtualHost *:80>
    ServerName www.YOURDOMAIN
    ServerAlias YOURDOMAINALIAS
    DocumentRoot /var/www/YOURPROJECT/

    ServerAdmin ADMINEMAIL

    # Logfiles:
    CustomLog /var/log/apache2/YOURPROJECT combined
    ErrorLog /var/log/apache2/error-YOURPROJECT
    LogLevel warn

    <Directory "/var/www/YOURPROJECT/">
            Options FollowSymLinks
            AllowOverride All
            Require all granted                                                                                                                                                                    
    </Directory>                                                                                                                                                                                

    DirectoryIndex index.php index.html

    # PHP Flags
    php_admin_flag engine on
    php_admin_flag short_open_tag on
    #use only <?php

    php_admin_flag safe_mode off
    php_admin_flag register_globals off
    php_admin_flag allow_url_fopen on
    php_admin_flag allow_url_include off
    php_admin_flag display_errors off
    php_admin_flag display_startup_errors off
    #php_value error_reporting 2039

    #php_admin_value open_basedir "/var/www/YOURPROJECT/:/tmp"
    php_admin_value memory_limit 512M
    php_admin_value date.timezone "Europe/Berlin"
</VirtualHost>
```
