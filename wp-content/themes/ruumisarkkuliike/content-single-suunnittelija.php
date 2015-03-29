<?php
/**
 * @package Honkasen Ruumisarkkuliike
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

        <?php the_field('titteli'); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

        <?php require_once('partials/single-header-images.php'); ?>

        <?php require_once('partials/share.php'); ?>

	</header><!-- .entry-header -->



	<div class="entry-content">

		<?php the_content(); ?>
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
