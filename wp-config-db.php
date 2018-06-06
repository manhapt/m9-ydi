<?php
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
$connectStr_dbHost = $connectStr_dbHost ?? 'localhost';
$connectStr_dbName = $connectStr_dbName ?? 'database_name_here';
$connectStr_dbUsername = $connectStr_dbUsername ?? 'username_here';
$connectStr_dbPassword = $connectStr_dbPassword ?? 'password_here';

function explodeConnectionStrings($env, &$connectStr_dbHost, &$connectStr_dbName, &$connectStr_dbUsername, &$connectStr_dbPassword) {
    foreach ($env as $key => $value) {
        if (strpos($key, "MYSQLCONNSTR_") !== 0) {
            continue;
        }

        $value = rawurldecode($value);
        if (false === strpos($value, 'Data Source') || false === strpos($value, 'Database')
            || false === strpos($value, 'Password') || false === strpos($value, 'User Id')) {
            continue;
        }
        $connectStr_dbHost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
        $connectStr_dbName = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
        $connectStr_dbUsername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
        $connectStr_dbPassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
    }
}

explodeConnectionStrings($_ENV, $connectStr_dbHost, $connectStr_dbName, $connectStr_dbUsername, $connectStr_dbPassword);
explodeConnectionStrings($_SERVER, $connectStr_dbHost, $connectStr_dbName, $connectStr_dbUsername, $connectStr_dbPassword);

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