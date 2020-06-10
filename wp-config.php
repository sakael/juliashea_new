<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/nfs/c03/h04/mnt/50168/domains/staging.juliashea.com/html/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'db50168_juliashea_staging');

/** MySQL database username */
define('DB_USER', 'db50168_chesa');

/** MySQL database password */
define('DB_PASSWORD', '-vw5q7V8');

/** MySQL hostname */
define('DB_HOST', 'internal-db.s50168.gridserver.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'xHti&Cti]-ZQ&> v%Y).T3p t>,+03J57w|C31<NkB8uJ5)x36p_T8ag|y`2_`Kq');
define('SECURE_AUTH_KEY',  'blu|3+)|P>}REnf%|?+7&HLb@{5#e<6KXS_j#eM-~bV :_8s-|?8pFP:%RNe[OT%');
define('LOGGED_IN_KEY',    'W,ZDjQ>=6HUP5dVg?=Ntd&w(4s7IFJ0x0^#Bk=gyOW0+>A6``n=2A-l+x$jdVp9B');
define('NONCE_KEY',        'YNijAsu@D,I#$p6 ]c5XbNcW)nu[t<mnMC!5})`8hcQ.^&H :gsvsu-ZKm3+cp;k');
define('AUTH_SALT',        'mW2`p9|es-p^$T`x?_;#4=,A)Exv3ubDA;t6 pH7(ZWWh-1#Ir;%79{oDFk.-?$B');
define('SECURE_AUTH_SALT', 'R-xWm&9Ak4|izH+}>,#LJC!lhDq?_-Y1@g3UF{c#P-pq%6:_=>#p8<1`=q.D<9u)');
define('LOGGED_IN_SALT',   '-0P+Y1%=I7E(n?2, vF)7Ae=3:{=wIb+^:{$1nNsSEw$~z-<2Z,|HAeEBL$&Y<W,');
define('NONCE_SALT',       'TF7NgDCvcV=#+3K.(@=KcT!rNRE[F0)f(VwiDki&?]wOLGFYx#G.WX};:1+e<&tY');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'realestate_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
