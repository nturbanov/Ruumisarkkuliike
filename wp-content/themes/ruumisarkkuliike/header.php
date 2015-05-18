<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Honkasen Ruumisarkkuliike
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<?php wp_head(); ?>

<?php if (!is_user_logged_in()) : ?>

<!-- <style>
    #masthead,
    section,
    #colophon {
        display: none;
    }
    #title {
        display: block;
    }
</style> -->

<?php endif; ?>

</head>

<body <?php body_class(); ?>>
    <div id="foo">
    </div>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'ruumisarkkuliike' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<!-- <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2> -->
		</div>

        <div class="nearest-dist">
            <span>Lähin hautaustoimisto <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></span>
            <div>
                <div class="dist">
                    <div class="loader"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Etsitään lähintä toimistoa</div>
                </div>
                <a class="all" href="/jalleenmyyjat/">Katso kaikki hautaustoimistot »</a>
            </div>
        </div>

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <div class="menu-toggle"><div class="burger-icon"></div></div>
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </nav><!-- #site-navigation -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
