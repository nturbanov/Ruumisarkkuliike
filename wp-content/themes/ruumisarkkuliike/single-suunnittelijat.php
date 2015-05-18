<?php
/**
 * The template for displaying all single posts.
 *
 * @package Honkasen Ruumisarkkuliike
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
            if ( 'suunnittelijat' == get_post_type() ) {
                get_template_part( 'content', 'single-suunnittelija' );
            }
            else {
                get_template_part( 'content', 'single' );
            }
            ?>

			<?php //ruumisarkkuliike_post_nav(); ?>

            <?php
            // $prev = mod_get_adjacent_post('prev', array('verhoillut-arkut', 'puuarkut', 'uurnat'));
            // $next = mod_get_adjacent_post('next', array('verhoillut-arkut', 'puuarkut', 'uurnat'));
            ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php include_once( 'partials/suunnittelijan-mallistot.php' ); ?>

<?php get_footer(); ?>
