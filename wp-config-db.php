<?php
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
$connectStr_dbHost = $connectStr_dbHost ?? 'localhost';
$connectStr_dbName = $connectStr_dbName ?? 'database_name_here';
$connectStr_dbUsername = $connectStr_dbUsername ?? 'username_here';
$connectStr_dbPassword = $connectStr_dbPassword ?? 'password_here';

foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_") !== 0) {
        continue;
    }

    $connectStr_dbHost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectStr_dbName = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectStr_dbUsername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectStr_dbPassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $connectStr_dbName);

/** MySQL database username */
define('DB_USER', $connectStr_dbUsername);

/** MySQL database password */
define('DB_PASSWORD', $connectStr_dbPassword);

/** MySQL hostname */
define('DB_HOST', $connectStr_dbHost);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');