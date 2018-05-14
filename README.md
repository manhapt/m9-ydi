# Setup
Requirements: PHP 5.6+

1. Setup server
- apache: enable mod rewrite
```
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/www/wp"
    ServerName ydi.local
    ServerAlias ydi.local
	<Directory C:/xampp/htdocs/www/wp/>
		Options Indexes FollowSymLinks Includes ExecCGI
		AllowOverride All
		Order allow,deny
		Allow from all
	</Directory>
    ErrorLog "logs/ydi.local-error.log"
    CustomLog "logs/ydi.local-access.log" common
</VirtualHost>
```
- Microsoft IIS: already configured in web.config file

2. Setup wordpress
- wp-config.php
define('WP_SYMFONY_PATH', __DIR__.'/../sf/');
define('WP_SYMFONY_ENVIRONMENT', 'dev');
define('WP_SYMFONY_DEBUG', true);

- Activate plugin "Ekino Wordpress Symfony"

3. Setup symfony
- Update database information in sf/app/config/parameters.yml
- run composer install: 
```
cd sf
php ../composer.phar install
```
- run update db
```
php bin/console doctrine:schema:update --force --dump-sql
```


