<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Honkasen Ruumisarkkuliike
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->
			<?php

            $args = array(
                'post_type' => 'jalleenmyyja',
                'posts_per_page' => -1
                );

            $jalleenmyyjat = get_posts($args);

            $locations = array();

            $n = 0;

            foreach ( $jalleenmyyjat as $jalleenmyyja ) {
                $locations[$n] = get_field('osoite', $jalleenmyyja->ID);
                $locations[$n]['nimi'] = $jalleenmyyja->post_title;
                $locations[$n]['puhnro'] = get_field('puhelinnumero', $jalleenmyyja->ID);
                $locations[$n]['nettisivut'] = get_field('nettisivujen_osoite', $jalleenmyyja->ID);
                $n++;
            }
            ?>
                <div class="map-container">
                    <div class="acf-map">
                    <?php foreach ( $locations as $location ) : ?>

                        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                            <h4><?php echo $location['nimi']; ?></h4>
                            <div class="address"><?php echo $location['address']; ?></div>
                            <div class="puhnro"><?php echo $location['puhnro']; ?></div>
                            <a target="_blank" href="<?php echo addScheme( $location['nettisivut'] ); ?>"><?php echo $location['nettisivut']; ?></a>
                        </div>

                    <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-container">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control typeahead" placeholder="Kirjoita kaupunki tai postinumero" aria-describedby="basic-addon2">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </span>
                        </div>
                    </form>

                    <form class="mobile">
                        <select class="form-control">
                            <option selected="selected">Valitse paikkakunta</option>

                        <?php
                        $args = array(
                            'post_type' => 'jalleenmyyja',
                            'posts_per_page' => -1,
                            'orderby' => 'menu_order',
                            'order' => 'ASC'
                            );

                        $jalleenmyyjat = get_posts($args);
                        $paikkakunnat = array();

                        foreach ( $jalleenmyyjat as $jalleenmyyja ) {
                            $paikkakunnat[] = get_field('paikkakunta', $jalleenmyyja->ID);
                        }

                        $paikkakunnat = array_unique(array_filter($paikkakunnat));

                        // This is for sorting posts based on their titles for umlauts
                        function umlaut_sort($a, $b) {
                            return strcoll(strtolower($a), strtolower($b));
                        }

                        function sort_by_umlaut_title($array) {
                            usort($array, "umlaut_sort");
                            return $array;
                        }

                        $paikkakunnat = sort_by_umlaut_title($paikkakunnat);

                        foreach ( $paikkakunnat as $paikkakunta ) : ?>
                            <option><?php echo $paikkakunta; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </form>

                    <div class="lahimmat-jalleenmyyjat">
                    </div>
                </div>
            </article><!-- #post-## -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
