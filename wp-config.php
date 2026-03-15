<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', "dn072025_dynex" );

/** Database username */
define( 'DB_USER', "dn072025_dynex" );

/** Database password */
define( 'DB_PASSWORD', "7%)kZ3brA5" );

/** Database hostname */
define( 'DB_HOST', "dn072025.mysql.tools" );

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
define( 'AUTH_KEY',         'i.&1kDDD+Q=8/!m50P}+Xm)H#/DCiB 755`P%PKd[MBCQ4cZprm-OAlxp`G %Vs3' );
define( 'SECURE_AUTH_KEY',  'A[=fj*flyLq1XKMz*UwmUFST3y)0;@5]/xV}A=ztf0goM!QzP)?YLw+fFR6?xf5g' );
define( 'LOGGED_IN_KEY',    '][crr am@0aOW/{yR=KJp.v/=Tha}& ~I2nu;0s)K:buQ c<aO81Ho3}a?b.Pd0&' );
define( 'NONCE_KEY',        'Xmi+D=gh~mTEpA.S1N~Dq&Vt#_ktd~eziONQjk3ESk#]~ne?Yz~2[h`Q5p(c%VzK' );
define( 'AUTH_SALT',        'u8r8e/ST&M}<;<))={xHx8gin^UV=)!Y:dU,4&jxmzQBgiFsD_5pa:DT9k<IK#jW' );
define( 'SECURE_AUTH_SALT', '2pdN6;F$H)4C6I-00].9+p]Qrk~R:8;9na7^ek,oIOafTSuA$9x%/#yA{W[FNLy0' );
define( 'LOGGED_IN_SALT',   '}#9Pje7*2dY*]MWFLpxFN.2A2#(OW;+dS2$ {w%kK//M,&I83,~d%,XygfW<P7<H' );
define( 'NONCE_SALT',       'Fg&3MY`3LqAA7c.N&SV&=a*R_VXV;OK>A0:wkasiLqAjp@`R:=7@[sh>Zq,d=b*J' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
