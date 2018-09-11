<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
/** Configure your DB information here */
$connectStr_dbHost = '127.0.0.1';
$connectStr_dbName = 'ydi_new';
$connectStr_dbUsername = 'root';
$connectStr_dbPassword = 'hieunc';

require_once 'wp-config-db.php';

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '7Iw=Al4^}a2v|q|mp9u487F l=yf wScuKDS^2dyIfBb^FpE!TkyJC%Fr^d`e=Ji');
define('SECURE_AUTH_KEY',  'kzxM$:NE:v5qLhGe7$XYiuzZ`u~lhp!_j0LZtW0`!7{l9SX9-H3)`GTWI!cL=:Vy');
define('LOGGED_IN_KEY',    '/V5 ^|,0eIIF<z9=iqjvJ,vZ&XoX?rWkp~VWj~/C`Q[JCYXE{A2<D/@Y~qiU?wch');
define('NONCE_KEY',        'szW/w0>!i#|w%~Tz#>iL:[Nhd^.8F[`mGd6r1>YDUzIZP<-&$i(CjyZo0TO/]8ZE');
define('AUTH_SALT',        'LOJa^EVgrkG&{?kW#2oe;G+W6$=97lBUtboD[^Eh(HO7YtE%H.?}?gOve7f+=?C7');
define('SECURE_AUTH_SALT', 'ui8p q0H&GrU#cr1hTGLrSpmcY]XIea$ij<ZBA&m_4`#.BBfk(.TEim9vY|D5kIa');
define('LOGGED_IN_SALT',   'G=&5%9}J+^p5z/q$q!O>(<yw,KQ`y,io*.O>i0yD}mz[i%!qBx@9%|O%xJW5 HY2');
define('NONCE_SALT',       'R_r>XdV4u9s!^mGSrfE(mB8!wqLF?]E:9<4GDU%<V>RoT==d4ji=LN1S=pe fTg`');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define('WP_SYMFONY_PATH', __DIR__.'/sf/');
define('WP_SYMFONY_ENVIRONMENT', 'prod');
define('WP_SYMFONY_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
