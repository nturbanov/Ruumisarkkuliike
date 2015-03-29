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

            <div class="prev">
            <?php if($prev) : ?>
                <a href="<?php echo get_permalink($prev->ID)?>"><?php echo $prev->post_title; ?></a>
            <?php endif; ?>
            </div>

            <div class="next">
            <?php if($next) : ?>
                <a href="<?php echo get_permalink($next->ID)?>"><?php echo $next->post_title; ?></a>
            <?php endif; ?>
            </div>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php include_once( 'partials/suunnittelijan-mallistot.php' ); ?>

<?php get_footer(); ?>
