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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'elearning');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'hieunc');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '137>4yUp=c[c0~j=LvOM}`5>@;KtY<-^hL}NwZ^EK@+l4t6{<bZ-qT7yHg<vvEsY');
define('SECURE_AUTH_KEY',  ']&TZTG8_:)uRb.JUbeV+]3,eOmL(4FH=Q3ZR2~O1bd=xm6%x}fV(oK`V#?b[*n)n');
define('LOGGED_IN_KEY',    '6iU2,WeflgTwc/oI;%hq`Pr:0>)!Y`5%6)r{,|j/olXe0_C>Tu1BhK9M@p1C6..8');
define('NONCE_KEY',        '0#1cv$/kxukC`+onM-gr T$[sH/:5#x`}AE#u:)urLA~!#yI<]` |tUKLJ=2C:r:');
define('AUTH_SALT',        'VueK]~ erh&FJfMCyGk[kusGT,K@)0~?l8swE]b-Ztiy4+.`hHh{@g$u4W ?V)c*');
define('SECURE_AUTH_SALT', 'uDGrsR)_{Ep[fl/V!)s#gRa]nh40FcbJBcb`QlWY{d>,zv.(-P<d=N+3mo}Skivw');
define('LOGGED_IN_SALT',   '3%l+AHh-M~n`1U{x bA,3vO#u:eVa^aY?5._kScH]E7@_S.SKj}mDkJg^[j%[4 6');
define('NONCE_SALT',       ':3Ayhi-rV:E_nI+wTS+D^wMh/,$7^*G _-FheRRgmCc7MdrpWVyo9fY#;DNfp=Zy');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
