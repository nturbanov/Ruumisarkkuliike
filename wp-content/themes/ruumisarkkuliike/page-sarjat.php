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

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

            <?php endwhile; // end of the loop. ?>

            <?php
                $terms = get_terms( 'sarjat' );
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>

                <div class="kaikki-sarjat">

                <?php foreach ( $terms as $term ) : ?>

                <article>
                    <header class="entry-header">

                        <a class="product-image" href="<?php echo get_term_link( $term, 'sarjat' ); ?>">
                        <?php $term_image = get_field('sarjan_kuva', $term); ?>
                        <img src="<?php echo $term_image['sizes']['large']; ?>" title="<?php echo $term_image['title']; ?>" alt="<?php echo $term_image['alt'].' '.$term_image['description']; ?>" width="<?php echo $term_image['sizes']['large-width']; ?>" height="<?php echo $term_image['sizes']['large-height']; ?>" />
                        <h1 class="entry-title"><?php echo $term->name; ?></h1>
                        </a>
                    </header><!-- .entry-header -->

                    <footer class="entry-footer">
                        <?php ruumisarkkuliike_entry_footer(); ?>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-## -->

                <?php endforeach; ?>

                </div><!-- .kaikki-sarjat -->

            <?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
