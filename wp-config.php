<?php
//Begin Really Simple SSL Server variable fix
// Remove the // on the next line for https
 //$_SERVER["HTTPS"] = "on";
//END Really Simple SSL
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

 // define( 'DBRAINS_API_BASE', 'http://api.deliciousbrains.com' );

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'kri');

/** MySQL database username */
define('DB_USER', 'kostas');

/** MySQL database password */
define('DB_PASSWORD', 'kostas');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '-LM5=q5mqSyy-+R#w1U#CdKxRRhUjcelf4*=+z|EG>-ySA_tgr~$Fr>G3zs)-g@-');
define('SECURE_AUTH_KEY',  'BPJzuBW|5_>PMGncGwAvTmOK~2y{L1<SGbyyIPw7TI*xBrFcHR|_#$7y;> c%=L8');
define('LOGGED_IN_KEY',    '5M?CRZrwS|&na50V(k=>r5~EBwL6v18P.v){3N0j@8FVRv-*A3e+BR13h,Pt|g5g');
define('NONCE_KEY',        'A^tn~{{b4vvPm+Bu#%5AYsR`z:r)2cUx@/-3}4IV%cu%[}h%y*]VYLXX2h)r$^y,');
define('AUTH_SALT',        '[LDnHlsS@Sj1 Md[|6KT^m+o?->,{2^Au06Rr,HqJV@)$,N%-agBwg2*h$E[2`%5');
define('SECURE_AUTH_SALT', '1X%1(tu;@kdHw+3eL10SzY@pj-QST+C[)4L[<kL_8b?:E{kR4$HkfZ9<+YJ#/)B+');
define('LOGGED_IN_SALT',   '8aU,AfrVIj-|whNVe~VtHg#1aO~t1gJ3|vDAAymtU F&N@0>E3JyCG8%mxr7M7S5');
define('NONCE_SALT',       'n7Wh^-_i(5j]zg2;+!66|YGw8liYG._uXg3vr~U6-4>P1Fa&/PtY1(1&uf_^[nlC');
// define ('WP_PROXY_HOST', 'www.proxy.neu.edu');
// define ('WP_PROXY_PORT', '3128');
// define ('WP_USEPROXY', 'TRUE');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
