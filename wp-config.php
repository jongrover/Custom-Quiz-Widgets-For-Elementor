<?php
define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.
define( 'WP_CACHE', true );
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'learneng_wp348' );

/** MySQL database username */
define( 'DB_USER', 'learneng_wp348' );

/** MySQL database password */
define( 'DB_PASSWORD', 'S)]mQHp809' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'sgitetizpavope7kfjvhj8iqufpazxjunllxtpvf6rcrsx1ndmmqpcfbqmry7tnk' );
define( 'SECURE_AUTH_KEY',  'xanmlxlkzju1mmxo1wzvfynkbcbm9zrvxwtsf03l9tl3qtcr0109pmfl6n6dtnqo' );
define( 'LOGGED_IN_KEY',    'eh4kkxkpob5nrkdyxzzftfzajc2cwo29eiqi2ywbu3m5kgr81rtxahfmuecgfeyi' );
define( 'NONCE_KEY',        '5jhmx0zz62vltsswebp6bsfvqhofwvrfqb5bnref8cgolvxbripoqeolmkgmtman' );
define( 'AUTH_SALT',        'a5ecmozdolvts45myxsvuuljmupuqbgkcmliuww3aoxrszdjgvro3wkfa1losiqj' );
define( 'SECURE_AUTH_SALT', '3cgaowdnbxnmost0vc1kekoobztmeth04tpscuejytscoaxtnaiue9eqghq6kuhs' );
define( 'LOGGED_IN_SALT',   'b4oqbxear1zxoijske1mv96s8ys5gmfwuedxxzna5d0fald4bimx13eg7jzgsocr' );
define( 'NONCE_SALT',       'qvc5qh6ljijsktekyyjnnxx2emul9gkqrcpyar8p93ludhh4oqmqieuikaaqbchk' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpys_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
