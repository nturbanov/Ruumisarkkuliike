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

			<?php

            $args = array(
                'post_type' => 'jalleenmyyja',
                'posts_per_page' => -1
                );

            $jalleenmyyjat = get_posts($args);

            $locations = array();

            foreach ( $jalleenmyyjat as $jalleenmyyja ) {
                $locations[] = get_field('osoite', $jalleenmyyja->ID);
            }
            ?>

                <div class="acf-map">
                <?php foreach ( $locations as $location ) : ?>

                    <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                        <h4><?php the_sub_field('title'); ?></h4>
                        <p class="address"><?php echo $location['address']; ?></p>
                        <p><?php the_sub_field('description'); ?></p>
                    </div>

                <?php endforeach; ?>

                </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
