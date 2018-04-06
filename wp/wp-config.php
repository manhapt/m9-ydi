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
define('DB_NAME', 'ydi');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'mysql');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD', 'direct');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'p{Jxh*|@S@C8UP!2&KNCjKT}OnD>!{1 v&jw)i,K(R{$Av?@G(q:=32 f$FDM61v');
define('SECURE_AUTH_KEY',  '#HFjqS;2<q2y}*u=CIf;r)F:bj.kyQ5,W=Tp}#oMH__s^C2/B@r-Ip[xK^R]P1 l');
define('LOGGED_IN_KEY',    'z;NK_Z6[m/sty#u[-%:(${>l[KE&CD(Jv*;?@,M@2:iQkKqBTt3iWJh(>{X7:E u');
define('NONCE_KEY',        '%+ZCZf(}LU$}V,O*8_L8:HJ!IH$Zp36b%R^v=w{p6g)oTjE;1QB8feYdq+k;m197');
define('AUTH_SALT',        '@hZ~^ZFJLSo*@vl%4m*wHLxz[8ivBf~V58pC$l9,OGh#>G@=`!}B}[Sjb_mG=T]t');
define('SECURE_AUTH_SALT', '*n9~2<YL +uk41[DZTGvB{q9:2OBVYa,C[c)Pw2v}|3pb-88ber8N^|yK] m6ymh');
define('LOGGED_IN_SALT',   '@(z$rM<W^:h=*3])POSH/dG?/#j+&_*|~^OI>Mwt~s_Dgp3C}ve@IPG]Jpf/PTtP');
define('NONCE_SALT',       'M 5],u{L|&VM_E,&xLeKF5$~(}MRF~YEVBF*!$E;f+ofvGr0nG_)2Q1+d}`<-7zt');

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
