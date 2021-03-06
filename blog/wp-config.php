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
if ($_SERVER['SERVER_NAME'] != 'localhost' && $_SERVER['SERVER_NAME'] != 'linosys.info' && $_SERVER['SERVER_NAME'] != '52.88.79.3') {
    define('DB_HOST', 'roughsheet-test.co8lze8dd3vj.us-west-2.rds.amazonaws.com');
    define('DB_USER', 'roughtest');
    define('DB_PASSWORD', 'linosys123');
    define('DB_NAME', 'roughsheettest');
} else if ($_SERVER['SERVER_NAME'] == 'roughsheet.com' || $_SERVER['SERVER_NAME'] == 'www.roughsheet.com') {
    define('DB_HOST', 'aa1bala15nso8za.co8lze8dd3vj.us-west-2.rds.amazonaws.com');
    define('DB_USER', 'awsuser');
    define('DB_PASSWORD', 'awsuserpass');
    define('DB_NAME', 'roughsheet_database_1423552512');
} else if ($_SERVER['SERVER_NAME'] == 'linosys.info') {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'linosys_pravin');
    define('DB_PASSWORD', 'Pr@v!n007');
    define('DB_NAME', 'linosys_roughsheet');
} else {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'roughsheet');
    $db['default']['hostname'] = 'localhost';
    $db['default']['username'] = 'root';
    $db['default']['password'] = '';
    $db['default']['database'] = 'roughsheet';
}


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/* * #@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'h/|W=m{(H8my%{#fAmZN3k)okWfD}IY%!<I5}9>!&L2IhzjfdMw~TOh2!!%*/T:g');
define('SECURE_AUTH_KEY', 'f8[a{uc@z2p$0lHg),g54rid/iRJ/&P:)^-(!/IZa=eTV?=5@%t0PzaiP]b3BX5M');
define('LOGGED_IN_KEY', '_#WVADjZq_|ps3(y]FvhWx<cBStyl-6vlvxJZBh<;3S8mFwt,AAy2`~6%w$-,?X`');
define('NONCE_KEY', 'YIr[k-{9W?~od3(?ES9+x gj4khr=|;D:Ciz9_pHs|6>? fm9e%^B+c0<]/2CrP(');
define('AUTH_SALT', '*>G[:?*Asbt $^Yh-[U>T05{X+LZv]Ll+BB0Bn3^>C1-ERfyRmnL%d&!xyb5%eOF');
define('SECURE_AUTH_SALT', '4nFkF;V-bIp[IVW}CYRhX/i3ggtKhVage0^GMxnY<TLuHCU~}NJE}u(A8J50(3N@');
define('LOGGED_IN_SALT', 'bS)wL9xDP;o?uwNZRh9odB!T~o9-Nre7c(lG[)q7pB=0U(~Y_|^([p:`Xj_.LQFo');
define('NONCE_SALT', 'Hle`q 4$}(LCIr3>=Bfdhwqf3Gd25z1pxWlDa+&2q5(3IQQ!qDEBV$D-_y4}3.Kg');
define('WP_DEBUG', false);






/* * #@- */

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
