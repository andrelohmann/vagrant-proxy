# Vagrant Cloud - (c) Andre Lohmann (and others) 2015

## Maintainer Contact 
 * Andre Lohmann
   <lohmann.andre (at) gmail (dot) com>
	
## Requirements
 * composer/installers
 * silverstripe/framework
 * andrelohmann/silverstripe-framework-fixes
 * andrelohmann/silverstripe-themes-bootstrap
 * php-ffmpeg/php-ffmpeg
 * unclecheese/betterbuttons
 * andrelohmann/silverstripe-geoip
 * andrelohmann/silverstripe-localegeoip
 * andrelohmann/silverstripe-dependentdropdownfield
 * andrelohmann/silverstripe-bootstrap_extra_fields
 * andrelohmann/silverstripe-bootstrap_navbar_languageform
 * andrelohmann/silverstripe-bootstrap_navbar_loginform
 * andrelohmann/silverstripe-bootstrap-tagfield
 * andrelohmann/silverstripe-extendedobjects
 * andrelohmann/silverstripe-geoform
 * andrelohmann/silverstripe-gridfieldextensions
 * andrelohmann/silverstripe-legacyfields
 * andrelohmann/silverstripe-mobile_detector
 * andrelohmann/silverstripe-session_extender
 * andrelohmann/silverstripe-smtpmailer
 

## Overview
this Project provides a software tool, to build your own selfhosted vargant cloud based on the following tutorial

 * Following this introduction http://aruizca.com/steps-to-create-a-vagrant-base-box-with-ubuntu-14-04-desktop-gui-and-virtualbox/
 * create minimal ubuntu virtual box with dhcp/nat; use vmdk for disk image
 * create user vagrant, password vagrant for compatibillity reasons
 * Build our own vagrant cloud https://github.com/hollodotme/Helpers/blob/master/Tutorials/vagrant/self-hosted-vagrant-boxes-with-versioning.md#5-hostingg

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

### Ubuntu Packages

In Ubuntu 14.04 install the following Packages

```
apt-get install libapache2-mod-php5 php5-cli php5-curl php5-gd php5-imagick php5-mcrypt php5-tidy php5-xcache php5-geoip geoip-bin php5-mysql mysql-server-5.6 mysql-client-5.6 mysql-server-core-5.6 mysql-client-core-5.6 php5-redis redis-server phpmyadmin libfaac0 libfaac-dev libx264-dev libx264-142 x264 libav-tools mcrypt
```
Activate rewrite and mcrypt modules

```
php5enmod mcrypt
a2enmod rewrite
service apache2 restart
```

#### Apache 2.4 vHost Example:

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
