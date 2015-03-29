<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Honkasen Ruumisarkkuliike
 */
?>

	</div><!-- #content -->

    <?php if ( is_singular( array( 'verhoillut-arkut', 'puuarkut', 'uurnat', 'suunnittelijat' ) ) ) : ?>
        <?php include_once('partials/muut.php'); ?>
    <?php endif; ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container">
        	<div class="row">
    			<a href="<?php echo get_post_type_archive_link( 'verhoillut-arkut' ); ?>"><span></span><span></span><span></span><span></span>verhoillut arkut</a>
                <a href="<?php echo get_post_type_archive_link( 'puuarkut' ); ?>"><span></span><span></span><span></span><span></span>puuarkut</a>
                <a href="<?php echo get_post_type_archive_link( 'uurnat' ); ?>"><span></span><span></span><span></span><span></span>uurnat</a>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
