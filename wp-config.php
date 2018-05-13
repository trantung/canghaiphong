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
define('DB_NAME', 'haiphongport');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'h;GvKqP=/ch2wT*Y~g[ZBiH}I(23!kl!Gp4p<Am:[0?1%D*o(~aK}fV@5W!NNg!H');
define('SECURE_AUTH_KEY',  'BTC=)#%biu7d2Qixv=}&GjALeVrtshH#Ol)aa{>GU;kkOFcH-[P]YX%yS4rF)eMZ');
define('LOGGED_IN_KEY',    '_f`aKm_2|R`oB!B}%09!y;NmQ2jM3B|9CjjA,1a]AAg#.E46!OMHi;akh!*N0lVz');
define('NONCE_KEY',        'e~!/^|l`++aSX[Nm3D=m_xIhqh[@p_P&?zAQ:E8h#N0;7.JnjU!zM9;g2vb^av@i');
define('AUTH_SALT',        'SEI:NFV^mb=Q3_`q];q!B<;6!g[/y@){>&XR]zLpy~953[vz+0Gt)0a%ojZ.CWMT');
define('SECURE_AUTH_SALT', '6]g.%tmO]p=z0HScl+V]0xyke0a@~;:+Ub~a2>5I}?N|/``9lq25WJ4p1!IyHlXp');
define('LOGGED_IN_SALT',   'SVwnvwR@$#9|i{@*>ER|n3Jjoa)EPj:pEUlWk>:7;99G:/5X}6DW ~lTMF>xV>ks');
define('NONCE_SALT',       'wfU}830b!U$MAr9$)!hTk4hL%DYlYM}4Bmz)_k!JcX;e?CTW-N}cB u@BfguZaq+');

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
