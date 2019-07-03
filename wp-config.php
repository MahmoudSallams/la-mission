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
define('DB_NAME', 'la-mission');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root_p@ssword');

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
define('AUTH_KEY',         '-VGSprbjLordM~I%@3<$wvm,3TT3m>~BK`e/`P}]-u-Z}|Dx;X7h [M)luVC:o(M');
define('SECURE_AUTH_KEY',  'TCC8 /p.=f0 fUE&g%(6oD:rj#Qj!Dgq(6=X {/Wpw}pf-(DH+f47@H{yx kSH`4');
define('LOGGED_IN_KEY',    '%eq?/^|]@)6IFd1Pg7:G5&#T#VgdRHw.lIfeTWsnXJ9<B0k:`[e]q=)H<N A]&2c');
define('NONCE_KEY',        'Pg!$U1bl^P]w1%au!gZ,Zix:Vd^D:gE)inN-!R06|/lQ*6]$Czs@t!F$^j<n`xB&');
define('AUTH_SALT',        'iam_NE<)rPte zO_PLX^#IiD,8#2XM_H2rz049TjovWq9Cl|@FHv,F}:n)C?G#4Q');
define('SECURE_AUTH_SALT', 'p#5?:uS,?%<}sdWF#2hvguGgps8Kt~hKQeIvF,%aWy6qf4H`G@rcD$K SH&><R R');
define('LOGGED_IN_SALT',   '(q,=i- 8,DGXa)pa*P#Cno$^8Bls)-[E*040N 5Ko i[lh2&aL4s-*WQWX* GS|<');
define('NONCE_SALT',       'T+8;k+U>@+[~LE-j^`$kJOdj?R8v#B: PB2ID[iz20f*U3NkWN?$o^_:e@LSeeu+');

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
define('WP_DEBUG', true);
define('FS_METHOD', 'direct');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
