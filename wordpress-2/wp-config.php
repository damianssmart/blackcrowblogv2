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
define('DB_NAME', 'wordpress bc');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'pVZ,[*kYJ&*ZX3N1RGZxpr/k$g}QJnFpg]6eWT&h72p*spIIR;1t^I?YIeZw@qn ');
define('SECURE_AUTH_KEY',  'YT%0KjA_du4C`#Y1q|,WJjH^&03oY9(@g}T5K!R;jM0}lI}A^Y27%<]2^Z3hxh73');
define('LOGGED_IN_KEY',    'L/N)pD@=S3yy-dz1Tf>D=5J*CT(g`$b|7xV;Dm~Wf,Hz@e>-]Q[mj_|j%Y!+ZN/U');
define('NONCE_KEY',        '0(W/c&e7l3/1`Mr~|63~=3!}^F|fYn+81i>F.1kl||0Bm8  |>K2A4WKJ%`eMe~&');
define('AUTH_SALT',        ')apO25 r?!G#YNrb~A*EkczbWz|xFrR<-EG`ajvI)*Q+S/5^VM@7+gTpk-V:3}W=');
define('SECURE_AUTH_SALT', ',`qMPU=~:;(ID3bDfM2/|Mdl#8K[k=+t>S+==Qyc*o|>hD{k7zsuv4|oa:rTN!+G');
define('LOGGED_IN_SALT',   'OK#xek9$OBSsKo1c5qP2Z!v#+iK(Av3qBI_v8.Ol8H>&m*@]z|^FyG9K&&y]4FWi');
define('NONCE_SALT',       'd:HFFf`q~<s0dc%|tx9l-TmQ!X!4bJW7=Fin~(n+nKp1B7F2}QCJqH Tx4pWN:#I');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
