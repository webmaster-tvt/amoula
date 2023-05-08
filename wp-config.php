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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
// define( 'WPCACHEHOME', '/home/oyebolat/public_html/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'u389210813_oyebola' );

/** MySQL database username */
define( 'DB_USER', 'u389210813_oyebola' );

/** MySQL database password */
define( 'DB_PASSWORD', 'u389210813_Oyebola' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '6vhtkoyjsvzpspjontpue4kbshnnxqopf8ljxz620fijqekqymy7ybeqjfzqp5jj' );
define( 'SECURE_AUTH_KEY',  'zxvuvw9zszvime2akmujpkcrt1sx18ygpr04u8ocwjotgilkzu3mipglktfhlg4o' );
define( 'LOGGED_IN_KEY',    'z27xhbpqmbnmtgqye8asxehzsjgz7hh0vsudqfgqcdhz3hbspadboxrr6buz8ew1' );
define( 'NONCE_KEY',        'vl32xs813mb5ir35mqpumzfpzoenci7fktvvwzfrfwhhrkk8dwj3aykpqcdcxvmr' );
define( 'AUTH_SALT',        'ictvpbj5rct7wdzydphhmxhbe3yhhrvlmx5ugddlyiz6spltluyby4ums6xbnplp' );
define( 'SECURE_AUTH_SALT', 'xlnb94whq0lymlu76ec8axfgvq2nruvivz2chmdrbobvbsjor3zovyaciyvsuodl' );
define( 'LOGGED_IN_SALT',   'vnjmzbg16mufvkfnbysnkfiqt2dzhzwoualicy63npz3ldilowiw877mthkqeiei' );
define( 'NONCE_SALT',       'kfi1cjtmxw6yqfp7dgmitequjxulwyinbkxumioicfjletzyuvt58cnvbofbjddc' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpdi_';

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
