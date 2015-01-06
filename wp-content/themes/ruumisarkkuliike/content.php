<?php
/**
 * @package Honkasen Ruumisarkkuliike
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

        <?php the_post_thumbnail(); ?>

		<?php
        $terms = get_the_terms( $post->ID, 'sarjat' );
        $term = array_pop($terms);
        echo '<a href="'.get_term_link($term->slug, 'sarjat').'">'.$term->name.'</a> | ';
        the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ruumisarkkuliike_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ruumisarkkuliike' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ruumisarkkuliike' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php ruumisarkkuliike_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->