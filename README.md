# Setup
Requirements: PHP 5.6+

1. Setup server
- apache: enable mod rewrite
```
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/www"
    ServerName ydi.local
    ServerAlias ydi.local
	<Directory C:/xampp/htdocs/www/>
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

2. Setup Azure (For Azure portal only)
Menu choose App Services > Choose service > Application settings 
> Application settings:
> Add new setting
| PHP_INI_SCAN_DIR | /home/site/wwwroot/azure.config/ |

Choose tab Development Tools > SSH
Find php.ini directory:
> php -i | grep "Scan this dir for additional .ini files"
/usr/local/etc/php/conf.d/

> cd /home/site/wwwroot/azure.config/
> ln -s /usr/local/etc/php/conf.d/* .


3. Setup wordpress
- wp-config.php
define('WP_SYMFONY_PATH', __DIR__.'/sf/');
define('WP_SYMFONY_ENVIRONMENT', 'dev');
define('WP_SYMFONY_DEBUG', true);

- Activate plugin "Ekino Wordpress Symfony"

4. Setup symfony
- Update database information in sf/app/config/parameters.yml
- run composer install: 
```
cd sf
php ../composer.phar install --no-progress --profile --prefer-dist --ignore-platform-reqs

```
- run update db
```
php bin/console doctrine:schema:update --force --dump-sql
```

5. Setup CKEditor
- Generate ckeditor + Symfony assets:
```
bin/console ckeditor:install
bin/console assets:install
```
- Symlink or copy 
{PATH_TO_m9-ydi}/sf/web/bundles
TO
{PATH_TO_m9-ydi}/wp
```
cd {PATH_TO_m9-ydi}/wp
ln -s {PATH_TO_m9-ydi}/sf/web/bundles bundles
```

6. Generate translation files 
 bin\console  translation:update vi --force