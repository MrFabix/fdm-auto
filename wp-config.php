<?php
/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file viene utilizzato, durante l’installazione, dallo script
 * di creazione di wp-config.php. Non è necessario utilizzarlo solo via web
 * puoi copiare questo file in «wp-config.php» e riempire i valori corretti.
 *
 * Questo file definisce le seguenti configurazioni:
 *
 * * Impostazioni del database
 * * Chiavi segrete
 * * Prefisso della tabella
 * * ABSPATH
 *
 * * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Impostazioni database - È possibile ottenere queste informazioni dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define( 'DB_NAME', 'fdm.auto' );

/** Nome utente del database */
define( 'DB_USER', 'root' );

/** Password del database */
define( 'DB_PASSWORD', 'root' );

/** Hostname del database */
define( 'DB_HOST', 'localhost' );

/** Charset del database da utilizzare nella creazione delle tabelle. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Il tipo di collazione del database. Da non modificare se non si ha idea di cosa sia. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chiavi univoche di autenticazione e di sicurezza.
 *
 * Modificarle con frasi univoche differenti!
 * È possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 *
 * È possibile cambiare queste chiavi in qualsiasi momento, per invalidare tutti i cookie esistenti.
 * Ciò forzerà tutti gli utenti a effettuare nuovamente l'accesso.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'tSCF<1yKgf&w+tl-l+Nl}f!:27j|B/veIF_2_{sJN`Rv,]DqF-%2>$Q%suydQhwA' );
define( 'SECURE_AUTH_KEY',  '~q1shh_MN/+t0.!-^ktQ,fz&aTTF%2lyg!Fju@(D#~k|J5!]<he;JKYIar/:Y4dP' );
define( 'LOGGED_IN_KEY',    '7@&?d)-gDuR4#xDe=#yt .CQXvW.QOvLbm=&w7x0{J!G}uAH<:C@yOG$>V:4wYAV' );
define( 'NONCE_KEY',        's@Cz:f}RknuTb|ck`8,qjOGL7]K8<(zwug33g097u(b+^>c1*5RrHU[ cM0]|lpC' );
define( 'AUTH_SALT',        '@`28iY18.2c;qmCczC-Y)n8g6_9XS.}^nC%yuZMI[ul41dY(~R+f/g[76G,{y{A?' );
define( 'SECURE_AUTH_SALT', '6JT$=c)Xs-Aj>&cwCIV(,XvwTvBjj%_7*rn8^sN{34`(@J;5:V}C|Kd=HfxLI_/C' );
define( 'LOGGED_IN_SALT',   '8Qx=/i5W-ldBwVgjD12Gc)w(ru+27:!O{|=QWbn6^*/^{[=c]1jY6:k^(EV%5z4k' );
define( 'NONCE_SALT',       'zDVw%/>H0|17+7ZElD.x{pTFl6BVZWb5|_t_+a/o?a*E%i7(:!w}#zh/*>XirW %' );

/**#@-*/

/**
 * Prefisso tabella del database WordPress.
 *
 * È possibile avere installazioni multiple su di un unico database
 * fornendo a ciascuna installazione un prefisso univoco. Solo numeri, lettere e trattini bassi!
 */
$table_prefix = 'wp_';

/**
 * Per gli sviluppatori: modalità di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi durante lo sviluppo
 * È fortemente raccomandato agli sviluppatori di temi e plugin di utilizzare
 * WP_DEBUG all’interno dei loro ambienti di sviluppo.
 *
 * Per informazioni sulle altre costanti che possono essere utilizzate per il debug,
 * leggi la documentazione
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Aggiungi qualsiasi valore personalizzato tra questa riga e la riga "Finito, interrompere le modifiche". */



/* Finito, interrompere le modifiche! Buona pubblicazione. */

/** Path assoluto alla directory di WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Imposta le variabili di WordPress ed include i file. */
require_once ABSPATH . 'wp-settings.php';
