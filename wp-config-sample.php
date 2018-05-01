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
define('DB_NAME', '');

/** MySQL database username */
define('DB_USER', '');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '');

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
define('AUTH_KEY',         'i+)sQ:6bzMeNs^N_a>9C5<6{>Co9IyN6^$`#Ak!}4Dy.,?D=&U[{kmFvV[7?c(Jv');
define('SECURE_AUTH_KEY',  'Kh$Ll43@T9(&Czk Fpp!:APg fseD#vU}d-UuMjk8)QGjf?&Hw`C6L`,t/(/>-NX');
define('LOGGED_IN_KEY',    'WMyb[z<0,n+0Y00-J?y9=h3_/R EvW(=|<vg<+@r(Yq[t2qO>sFNj|MJt,Na=TkW');
define('NONCE_KEY',        '!K(a= 6,{1!AVvb-:j`JVv+IVf7y/nqC1[=?U+*[^{4YujBRi<@[1TarZz ,Y#K,');
define('AUTH_SALT',        '4A1jAa1~z+!U92C{90bjZ!,oMmXkoC(Z-q)OaHq.7aY&[!1mBi%*}4)9B.NB+%Pb');
define('SECURE_AUTH_SALT', 'nG88XHQ(#NC|y:DhR&oW|T#5yR^n[5fhQm3*{UZlBS`YLgA}KRW?x1PJ*$xG3s;p');
define('LOGGED_IN_SALT',   'I3yqCd/~aKe9F/J-r(Q{xBO^+QW 3c@WE$Xav|q%WbaIK^GUn9h~Dn`tHb6 dWU6');
define('NONCE_SALT',       'EN l#,(4ab.z/A+x.d5]NlH274&,q+IRIY8Z-jZX1yEsua<ya0G~aUo>YT:3JS]~');

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

if($_SERVER['HTTP_HOST'] == "localhost")
{
	define('WP_LOCALHOST', true);
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

if(defined('WP_LOCALHOST')) {
	require_once(ABSPATH . 'kint.php');
}