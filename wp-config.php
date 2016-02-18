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
define('DB_NAME', 'wp_qlokare');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         ')P~?QrdxQXnj_]u)s(]UYAbE-OLJX4v Y+yX~$aJX6f+7v^LdL@p1g&Nab2r-8VA');
define('SECURE_AUTH_KEY',  'H)00<Q8i%1~wP3`V~5h:9EvF|6}-&I{Ac8QMJn_%c@F;sgF7t JH/uYN/S2b_`m|');
define('LOGGED_IN_KEY',    '9s+|.B<dksM+jN?%!CnbKqJ@6=o=L{?m%W-%V6N8c(e){JS<$Z}nnlk_I~.|:8-p');
define('NONCE_KEY',        'd#_hjF@&HM6<+Bn+kXf4AI[rA=WWP],Ij9Y|I_Bv?+;l-px-s1TcG}xzIv-S|jM~');
define('AUTH_SALT',        'v)O$S!J|nUU:o#.+>2e;&c&qY+qI:8|R4iGJ-v=li::b_&l9#W-`|~9w9`9R_ d+');
define('SECURE_AUTH_SALT', '+QyvUS!6aAKhkJk+A)HutF dh/O]={yEnG?JASNnoA:$p}ZSnbF*-f[_tN~ANf.o');
define('LOGGED_IN_SALT',   '/4 Tl+DZ{{^u{n^FC&O>Abjt;HqDvf8H!sL=_A+:gcbUI<1D3 F)#6GeYi9~AgnS');
define('NONCE_SALT',       '_x=DHf-k0!}qbSD!Ihc@-..dac#;p#WK;&gfOGbz{7-~pMb|#f<-}g3s^Zf8{XV.');

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
