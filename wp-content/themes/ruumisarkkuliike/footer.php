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
		<div class="site-info">
			<a href="<?php echo get_post_type_archive_link( 'verhoillut-arkut' ); ?>">verhoillut arkut</a>
            <a href="<?php echo get_post_type_archive_link( 'puuarkut' ); ?>">puuarkut</a>
            <a href="<?php echo get_post_type_archive_link( 'uurnat' ); ?>">uurnat</a>
		</div><!-- .site-info -->
        <div>
            <a href="mailto:info@ruumisarkkuliike.fi">info@ruumisarkkuliike.fi</a>
            <div class="tel">040 703 7332</a>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
