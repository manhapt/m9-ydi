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

2. Setup wordpress
- wp-config.php
define('WP_SYMFONY_PATH', __DIR__.'/sf/');
define('WP_SYMFONY_ENVIRONMENT', 'dev');
define('WP_SYMFONY_DEBUG', true);

- Activate plugin "Ekino Wordpress Symfony"

3. Setup symfony
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

4. Setup CKEditor
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