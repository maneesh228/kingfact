<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '];4n6`pm;Cd*XI`]a4s@9vPF^QJ9k]m?3W}pR GL%8)cY@3giZ*)Vp>E3fm|B~2x' );
define( 'SECURE_AUTH_KEY',   'ZB-FOhF-r_J,$|1NJfgjVfeeMrZ2yb<!j@>Q8RbV10z(:&E,y:@1.cb$6I?RqwE.' );
define( 'LOGGED_IN_KEY',     'U0,4v6hN+<9KR?=.p4{[Ck;-?ACOqKB@u{2=;3$P9@q@8.OT>uI!&2>_)U6LHNPq' );
define( 'NONCE_KEY',         '@aG~]Ch$Qp3-P`[9WY&m&dD7kR&;aPQ,j,zUPW~rV`YYK?r<}c#[hYtAT/):TYOo' );
define( 'AUTH_SALT',         ';/=mTDq=_{^-)Mpea[OiZu1UQaJm)Xp{nw@`%5>&lNe!3<RcyHA4wkA/x_ N}q[-' );
define( 'SECURE_AUTH_SALT',  '0;1+3,aQ;|,#v`Wp41xf7/l+(M4?lv:,&WyJ#PS 21C.oYyt-?!k1=p:f6$cW:Bo' );
define( 'LOGGED_IN_SALT',    'ry2ljLe/}]p/e4@6x(@]i^8HMQ6mPp)uK, sA$36W>tWnFs|ff-8R{UhhK$msL3U' );
define( 'NONCE_SALT',        '&WxG$UwH$w%tj%6P^he=0|5oOK<S]^v5a#-F|w$cL4^,;@o~[={;YZ12w$YCMoau' );
define( 'WP_CACHE_KEY_SALT', 'RP95#RjoncF7#F~ISm~U3,UVZ^%:2ko8c&9Gl=<h0=eh=KlaPyfsM$WZhG^=^@4v' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
