<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Honkasen Ruumisarkkuliike
 */

get_header();

// Tämmöstä shaibaa koska jostain syystä pre__getissä ei toimi set_post_type tax queryn kanssa

// global $wp_query;
// $wp_query->query_vars['post_type'] = array( 'verhoillut-arkut', 'puuarkut', 'uurnat' );
// $args = $wp_query->query_vars;
// query_posts( $args );
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="entry-header">
				<h1 class="section-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'ruumisarkkuliike' ), '<span class="vcard">' . get_the_author() . '</span>' );

                        elseif ( is_post_type_archive() ) :
                            echo '<div>Kaikki</div>';
                            post_type_archive_title();

                        elseif ( is_tax('sarjat') ) :
                            echo '<div>Sarja</div>';
                            single_term_title();

                        else :
							_e( 'Archives', 'ruumisarkkuliike' );

						endif;
					?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;

                    if ( is_post_type_archive() ) :
                        $obj = get_post_type_object( get_post_type($post) );
                        echo '<div class="post-type-desc">' . wpautop($obj->description) . '</div>';
                    endif;
				?>
			</header><!-- .page-header -->

            <div class="archive-wrapper">

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', 'archive' );
				?>

			<?php endwhile; ?>

            </div>

			<?php // ruumisarkkuliike_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
