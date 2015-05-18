<?php
/**
 * @package Honkasen Ruumisarkkuliike
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

        <?php require_once('partials/single-header-images.php'); ?>

        <div class="subheader"><?php $sarja = wp_get_post_terms( $post->ID, 'sarjat' ); echo $sarja[0]->name; ?></div>

        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

        <div class="entry-meta">

        <?php
        $materiaalit = wp_get_post_terms( $post->ID, 'materiaalit' );
        // $sarjat = wp_get_post_terms( $post->ID, 'sarjat' );
        // $suunnittelijat = wp_get_post_terms( $post->ID, 'suunnittelijat' );
        // $avainsanat = get_the_tags();
        ?>

            <div>
                <div class="meta-item materiaalit">
                    <div class="label">Materiaalit</div>
                    <ul>
                        <?php foreach ($materiaalit as $materiaali) : ?>
                        <li><?php echo $materiaali->name; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="meta-item">
                    <div class="label">Kategoriat</div>
                    <div>
                        <?php echo get_the_term_list( $post->ID, 'sarjat', null, ', ', null ); ?>
                    </div>
                </div>

                <div class="meta-item">
                    <div class="label">Suunnittelija</div>
                    <div>
                        <?php $suunnittelija = get_field( 'suunnittelija' ); ?>
                        <a href="<?php echo get_permalink($suunnittelija); ?>"><?php echo $suunnittelija->post_title; ?></a>
                    </div>
                </div>

                <div class="meta-item">
                    <div class="label">Avainsanat</div>
                    <div>
                        <?php echo get_the_tag_list( null, ', ', null ); ?>
                    </div>
                </div>
            </div>

            <div class="related-product">
                <?php
                $product = get_field('yhteensopiva_tuote');
                // var_dump($product);
                if ( $product ) : ?>

                <div class="label">Samaa paria</div>
                <div>
                    <?php $sarja = wp_get_post_terms( $product->ID, 'sarja' ); ?>

                    <div>
                        <a href="<?php echo get_permalink($product); ?>">
                        <?php echo get_the_post_thumbnail( $product->ID, 'thumbnail' ); ?>
                        </a>
                    </div>

                    <?php if ( is_array( $sarja ) ) : ?>
                    <a href="<?php echo get_term_link( $sarja[0] ); ?>"><?php echo $sarja[0]->name; ?></a> | <a href="<?php echo get_permalink($product); ?>"><?php echo $product->post_title; ?></a> <?php $pto = get_post_type_object( $product->post_type ); echo strtolower($pto->labels->singular_name); ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

            </div>

        </div><!-- .entry-meta -->

        <?php include('partials/share.php'); ?>

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
