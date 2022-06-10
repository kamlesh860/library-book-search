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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'book_search' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'n>/} S^UC,TTBOzb_,(D]D7>]q[~,/*3CwRnLb9~Pm> l? +)/3RU)c$U&N.a%19' );
define( 'SECURE_AUTH_KEY',  '.x}S#IIwE KvFbnxMP){pF40!7YuW(g$Q]Zdm#LH.#]Zn*3NMP;g;WSc?<Cyr8`K' );
define( 'LOGGED_IN_KEY',    '|#34W&VTb7_s#A&X(O;]_{3W26pBUd5=0Kd3D:sy+$4:YF4BK.D[|}f+3BL:+| Y' );
define( 'NONCE_KEY',        '(^u kVqi&O*tn_:B>Q[Q:37<kUs]Y$Kol/CYcL-kvbDf681:qw#|2UnFZL|r_t7f' );
define( 'AUTH_SALT',        '1#i[zx;{0RK3xp&@~4C`W=;6d7uCyT{0K! %v!UeQ?RMdIT2[Fq!r7[q-wfHN|9c' );
define( 'SECURE_AUTH_SALT', '*pLqh{GQMt;8w9J4F$R(ehMbT?`]6IH0H&`g3]X#4m8Z~C&/_f0WS.o?-PuH,6[h' );
define( 'LOGGED_IN_SALT',   '1*N9=^BrgpBKXy]Zi=e+])y aL%pL<n*mO9<{ |-#Atfidgn6exXc*!-Up)&k|PP' );
define( 'NONCE_SALT',       'yQ@x,.Qz^{cyw}TEq?[)mq}_oP>F+xRlho]#pcVa{t<TyQW+8$M%*{SS|)qd2gYM' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_booksearch_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
