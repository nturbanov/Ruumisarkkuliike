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

	<footer id="colophon" class="site-footer" role="contentinfo">
        <div class="container">
        	<div class="row">
    			<a class="col-md-2" href="<?php echo get_post_type_archive_link( 'verhoillut-arkut' ); ?>">verhoillut arkut</a>
                <a class="col-md-2" href="<?php echo get_post_type_archive_link( 'puuarkut' ); ?>">puuarkut</a>
                <a class="col-md-2" href="<?php echo get_post_type_archive_link( 'uurnat' ); ?>">uurnat</a>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
