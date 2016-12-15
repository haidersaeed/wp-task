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
define('DB_NAME', 'local_wp_task');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '.HBhr,g a<0=CSE@n#<,H9h?*3mW74fK.hLAnV$!vWO/R? 5I9Dwe`<_E+PzA1h}');
define('SECURE_AUTH_KEY',  '3Dhuq62%`.;}9Z#>F!XEe553{&n%LeC|,}stOqqy#Jx.?lqV9q dm%DOP{J1Y8?V');
define('LOGGED_IN_KEY',    'T):d-C|n9-z,<@Am,:5~BE#p|p/u38F?)-/%X-Io@WwB0~zv~79T?:42qmtIcmI}');
define('NONCE_KEY',        'Wi8af3VF6ZLH_/=Qg]6^;GzY8ewC%iXF,6yHuF*QFje:?$ZR103o)kzcqN><T{/7');
define('AUTH_SALT',        ']g*KDrqeN{$m5_hTUZ@sLfL;w9q:SO-Gwxmp(B,NA7`XC~Ps~kSuf)-:-,UP_J@O');
define('SECURE_AUTH_SALT', 'B7QF=&y+yK};Jv$f/`+M]Z@{IOHZqz}DT?|Dmouw_t6R*P-Soh9^e]]Yh(6EXUGe');
define('LOGGED_IN_SALT',   'nBb`Y]~@olIG&=4lU=m@Hhn`qLXH$9~j6nAErVTmNEgHjcEri7IH)YH_8gLM8xY.');
define('NONCE_SALT',       '_z&ACC/!wU6w&n*a6&?98I&EO<<Mj5ZiEa$R8mo.< d~w`EShLu3h@h]mJ4rAcA,');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_ab_';

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
