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

                <div class="acf-map">
                <?php foreach ( $locations as $location ) : ?>

                    <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                        <h4><?php echo $location['nimi']; ?></h4>
                        <div class="address"><?php echo $location['address']; ?></div>
                        <div class="puhnro"><?php echo $location['puhnro']; ?></div>
                        <a href="<?php echo $location['nettisivut']; ?>"><?php echo $location['nettisivut']; ?></a>
                    </div>

                <?php endforeach; ?>

                </div>

                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Kirjoita kaupunki tai postinumero" aria-describedby="basic-addon2">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </span>
                    </div>
                </form>

                <div class="lahimmat-jalleenmyyjat">
                </div>

            </article><!-- #post-## -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
