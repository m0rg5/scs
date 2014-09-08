<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'spec1932_newscs');

/** MySQL database username */
define('DB_USER', 'spec1932_spec');

/** MySQL database password */
define('DB_PASSWORD', 'hgfhE5pjMHD4');

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
define('AUTH_KEY',         'Tb|),uVo]?l3Qod*BLh^+-Z+Bc?zq-.ZtRbO1HBHXo:slK<0]Os e`Dh[V9|CNN3');
define('SECURE_AUTH_KEY',  '6R@47qfOTtE0}/abt2 EN&y5Vq20fE,/nTp+CXePkFlZl*~[|3s*`/|j|g#mH4-]');
define('LOGGED_IN_KEY',    ';~6C^E?#N5<L`*:sH8,L)aQ9ClCjxCwI$~qpLVa=cT:cPDh{!p|R}0q^9h>+1U|V');
define('NONCE_KEY',        'xOG[3gc+WiJ&=B%tbd[YT}{`5kM^Qyf4[k+B+jk*t-.-=6q`!lkwmRi|n-^`Bsu@');
define('AUTH_SALT',        '^-i|l>7gB16rnl`]Glope=Fw0} 1]hHxv6$4ahJ](C!XgNw[=-MxsE/zweY`GB,J');
define('SECURE_AUTH_SALT', '7@,bu2 ;gzppCKK5|G9p8zY<G%@61Sd ?6|bKRzf%fA?fX^Va/l7%`@vXAS$f9I|');
define('LOGGED_IN_SALT',   'BS]YYp1Pv@ShUm+|eQX:A:2Bj?qFnVL%|-]ps7blebK5rBJN*_)W%hMm7At9+ePd');
define('NONCE_SALT',       'vxN&+zxKv1z#BDBDm7C&n_7!0,*GgpR3EeLpF@VHd!>e@!H`MlJE+X|d6q~zV/=L');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'scs_';

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