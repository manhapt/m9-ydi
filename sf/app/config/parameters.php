<?php
/**
 * We use this file to use the MySQL Connection String from Azure
 */
include_once('../../../wp/wp-config.php');
$container->setParameter('database_host', DB_HOST);
$container->setParameter('database_port', null);
$container->setParameter('database_name', DB_NAME);
$container->setParameter('database_user', DB_USER);
$container->setParameter('database_password', DB_PASSWORD);
$container->setParameter('mailer_transport', 'smtp');
$container->setParameter('mailer_host', '127.0.0.1');
$container->setParameter('mailer_user', null);
$container->setParameter('mailer_password', null);
$container->setParameter('secret', 'ThisTokenIsNotSoSecretChangeIt');