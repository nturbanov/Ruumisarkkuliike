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

get_header();

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

        <?php
        $args = array(
            'post_type' => array( 'verhoillut-arkut', 'puuarkut', 'uurnat' )
            );

        $my_query = new WP_Query( $args );
        ?>

			<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

				<?php get_template_part( 'content', 'archive' ); ?>

			<?php endwhile; wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
