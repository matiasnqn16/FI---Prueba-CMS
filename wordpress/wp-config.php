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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pruebacms' );

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
define( 'AUTH_KEY',         'n yn%IC{.9vyTzB{ds7$m<PdQc{Yb+c-T#}/w>Nu?7+Kg+vMs&:,|qt5GHv,=80e' );
define( 'SECURE_AUTH_KEY',  '9@@|*mmYzzBOhG26a;kLR,?F$-R=DmG#])3udY&IxGRE`1L:x8lM;5_V#<.#-ung' );
define( 'LOGGED_IN_KEY',    'AH;nK-$[^|fmnv#;,+K)hG9^JT[Z-`I(-u?9Q&g-HDZ&i5CjNPH(pm4d`{DEmA U' );
define( 'NONCE_KEY',        'A5}qu*uz/xUL)RE)dKFwN$Ha77`;MBO%Vl{jABe),7xrAEzRvD{%gc.pPK/KtW1 ' );
define( 'AUTH_SALT',        'Ju)Oc`B)^,|fB)-,0z=W#zO(IFdC&xN65S^abQ@pUSwT_i)w8jP!meLeFZ/]+OHU' );
define( 'SECURE_AUTH_SALT', ':HSiuzHQ8hl!h57l(z!oftv8^f=&.=h}_6[5BE[ekl#_b45zVt/@~J,2XnY&8HYc' );
define( 'LOGGED_IN_SALT',   '&n*M@)bFL(@(Br]p^1}NLrST6G{Fy(Vl}pdlXk. (hd=Aq!ur>6c]Wgo)vLs_ZnM' );
define( 'NONCE_SALT',       '5S-.6^FjopQ:T]:>=d-t$~J@cmvm{D$uM&X80$YIu6bOG*f[vaj<*!wO+ZQx2[%$' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
