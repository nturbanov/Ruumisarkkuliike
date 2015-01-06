<?php
/**
 * WordPressin perusasetukset.
 *
 * Tämä tiedosto sisältää seuraavat asetukset: MySQL-asetukset, Tietokantataulun etuliite,
 * henkilökohtaiset salausavaimet (Secret Keys), WordPressin kieli, ja ABSPATH. Löydät lisätietoja
 * Codex-sivulta {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php}. Saat MySQL-asetukset palveluntarjoajaltasi.
 *
 * Automaattinen wp-config.php-tiedoston luontityökalu käyttää tätä tiedostoa
 * asennuksen yhteydessä. Sinun ei tarvitse käyttää web-asennusta, vaan voit
 * tallentaa tämän tiedoston nimellä "wp-config.php" ja muokata allaolevia arvoja.
 *
 * @package WordPress
 */

// ** MySQL asetukset - Saat nämä tiedot palveluntarjoajaltasi ** //
/** WordPressin käyttämän tietokannan nimi */
define('DB_NAME', 'ruumisarkkuliike_fi');

/** MySQL-tietokannan käyttäjätunnus */
define('DB_USER', 'hkv-tukku.fi');

/** MySQL-tietokannan salasana */
define('DB_PASSWORD', '7Uja4JdEtZpPsy');

/** MySQL-palvelin */
define('DB_HOST', 'localhost');

/** Tietokantatauluissa käytettävä merkistö. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Älä muuta tätä jos et ole varma. */
define('DB_COLLATE', 'utf8_swedish_ci');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Muuta nämä omiksi uniikeiksi lauseiksi!
 * Voit luoda nämä käyttämällä {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org palvelua}
 * Voit muuttaa nämä koska tahansa. Kaikki käyttäjät joutuvat silloin kirjautumaan uudestaan.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'OC?7gQZP/!|`S)`U0$&y:yXn<L-C)Ir-BNAF=gnIO3CI9FhtMmu|JW$^F-o|Vy j');
define('SECURE_AUTH_KEY',  './-8rgJV4{W[[fg~SXfk&_rc^iT6$ /a+uv:lE3h/#Y)k(c~e$)l`o?Jj;qkWL}N');
define('LOGGED_IN_KEY',    '27ZUxu,F/n;gfiZ&%+XG3bf<e-E&3;(w=:3RC<F({-#Gt14eoH[qpV0j99AOE-cB');
define('NONCE_KEY',        ')&?>Xs[C6`O.:)2ifsM-{pT&8)XPxg8Xoj!BqlgR$`HnW*}E^ytdj1PHhJ8kB46t');
define('AUTH_SALT',        '|,MAcDM6ue-lS4@2@]OVg?{O9gzSrHr3G?oe$&4w)G^BliZ=[uUw=rWktGBT_Ej&');
define('SECURE_AUTH_SALT', 'K*P(%GM,<tQ9NEfY/uR[0,}ahMP||`3KHj5#m7gkncxDEKiM.|JR(vFUOOz?T2lS');
define('LOGGED_IN_SALT',   'Z.(7.EJ5fpoFpj2NUhwNn;4|n[ cEva4x[+A$Q/R)mxhcs[k]H-E_5qbhD+3;.||');
define('NONCE_SALT',       'ze (3sCXfa)KoQT+e|tbcwx+#&E!vI8#sik6e=j(e+UuI%0;N|3+Qrcp|:+1WIZU');
/**#@-*/

/**
 * WordPressin tietokantataulujen etuliite (Table Prefix).
 *
 * Samassa tietokannassa voi olla useampi WordPress-asennus, jos annat jokaiselle
 * eri tietokantataulujen etuliitteen. Sallittuja merkkejä ovat numerot, kirjaimet
 * ja alaviiva _.
 *
 */
$table_prefix  = 'wp_';

/**
 * Kehittäjille: WordPressin debug-moodi.
 *
 * Muuta tämän arvoksi true jos haluat nähdä kehityksen ajan debug-ilmoitukset
 * Tämä on erittäin suositeltavaa lisäosien ja teemojen kehittäjille.
 */
define('WP_DEBUG', false);

/* Siinä kaikki, älä jatka pidemmälle! */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
