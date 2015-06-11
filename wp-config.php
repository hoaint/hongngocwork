<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'benhvienthammy');

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
define('AUTH_KEY',         'X5re[_+2ze1RqbVI-..PEezz%)]~|e[KU;DE]%2,sEJ2<%~QF;hf_XKu^m${qx(C');
define('SECURE_AUTH_KEY',  'irq>-dBFZt+iYlJUo5)9.~Y2[L_DS_V|{f.*YnHAzS9fwH~f[RnXJs>SzsE0L/7G');
define('LOGGED_IN_KEY',    'YYc^|1(z6454[Au[|p;^$)tTCM?>C_|/ T-- Y+auM<}Y:ckQG?}[|5Rd^oj}2|]');
define('NONCE_KEY',        'U^9rGZ;<)D4}`-mY^3[:C.)Az(lZCuP-;sF]AJU9SrU%B>+j|+*+<|u#L8=iQsJ&');
define('AUTH_SALT',        'rs< 2J0=j,G.`*w7eiTN9pllA0lzmjNJa/30l?zSLww#|nhr~|8R8 SZ02e!!&d|');
define('SECURE_AUTH_SALT', '|e]!6)N244nKsS4Z(9N{#-uE=PaY.ev5YzlAk:]M)QLz*,uSHN2LlDMiZFj{}N&+');
define('LOGGED_IN_SALT',   'ufr x<Z+h#.N0!OgXo`o?cLPY10:uzIxM[=o!Qj,QjSpU7C/VS;7fG=D5`YU/+{/');
define('NONCE_SALT',       '<x7[QeO=xYN`#GH}Mg+|a:hO<a9HPYWeI_i=!TRH2Gqy~xvVU/7)aZ|-q[VV55|I');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'bvthammy_';

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
