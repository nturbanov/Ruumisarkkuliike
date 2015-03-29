<?php
/**
 * @package Honkasen Ruumisarkkuliike
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

        <a class="product-image" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>

		<?php
        $terms = get_the_terms( $post->ID, 'sarjat' );
        if ($terms && !is_post_type_archive( 'suunnittelijat' )) {
            $term = array_pop($terms);
            echo '<a href="'.get_term_link($term->slug, 'sarjat').'">'.$term->name.'</a> | ';
        }

        the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );

        ?>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ruumisarkkuliike_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<footer class="entry-footer">
		<?php ruumisarkkuliike_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->