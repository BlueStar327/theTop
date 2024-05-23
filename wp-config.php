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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'thetop' );

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
define( 'AUTH_KEY',         'uf2W_*A*=Cr6:[X+kV0D#v@nhBNcTAc@8??Ne?{XlQu:?(mgr>),I1aafyJxT:Hq' );
define( 'SECURE_AUTH_KEY',  'V&rPjY~JSK%@5z*TYppk/z0{[6Y5yQl]6KGqc{~9B>H~arse`i^&en{Tlp,$iH V' );
define( 'LOGGED_IN_KEY',    'YV<efB<qR$H}^Rl3&cno*hQj0uN0%=X@/e]YKnnBWVBy[|g=*f~Ct,(PO^J)QH%G' );
define( 'NONCE_KEY',        'qc)2C;E6a+*jWE}7_GMWfqI^AbUxXrS~m.e0Jr?GVmMwj#WTp1g%qZ]{>|+8v2dZ' );
define( 'AUTH_SALT',        '0,AdprqIVhZ6obh};Rw}D}$5Oxw)o2b/yHX:%/+9l#[8kgM6l^a30)M=SQ}?FU79' );
define( 'SECURE_AUTH_SALT', 'DiX]5*QB93b4@Xf/Y*SmYl9E)5Fhay=UOiOT*vuHx>HzV/hAlLSX,<@M>k&`]x+Y' );
define( 'LOGGED_IN_SALT',   'DyRhrSBifUODL#ZRvDX_zvGPI 3,OS))Knv ef#]f.Zq,{Xzm,}j>Oh)&(?xr;G0' );
define( 'NONCE_SALT',       '9-aj.<KAbIEYPsv3w}gA ZK1kt1zj{U M*xdtlU(5v{l+<Vz(J^(0us8[lq3;_mG' );

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
