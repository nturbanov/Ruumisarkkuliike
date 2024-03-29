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

			<section id="title">
                <img src="<?php echo get_template_directory_uri(); ?>/i/honkasen-logo.png" />
            </section>

            <?php

            // check if the flexible content field has rows of data
            if( have_rows('etusivun_nostot') ): $n = 0;

                // loop through the rows of data
                while ( have_rows('etusivun_nostot') ) : the_row();

                    if( get_row_layout() == 'taustakuvallinen_nosto' ): ?>

                        <section class="kuvallinen-nosto parallax-window" data-parallax="scroll" data-image-src="<?php $img = wp_get_attachment_image_src( get_sub_field('kuva'), 'full' ); echo $img[0]; ?>" style="background-image: url(<?php echo $img[0]; ?>);">
                            <div class="wrapper">
                                <h2 class="section-title"><?php the_sub_field('otsikko'); ?></h2>
                                <div class="description">
                                    <p><?php the_sub_field('teksti'); ?></p>
                                    <a class="button" href="<?php the_sub_field('linkki'); ?>"><?php the_sub_field('linkkiteksti'); ?></a>
                                </div>
                            </div>
                        </section>

                    <?php elseif( get_row_layout() == 'tuotekategoria_nosto' ): $post_type_object = get_post_type_object( get_sub_field('tuotetyyppi') ); ?>

                        <section class="kategoria-nosto<?php if( $n%2 !== 0 ) echo ' even';?>">
                            <div class="wrapper">
                                <div class="left">
                                    <h3 class="section-title"><?php echo $post_type_object->label; ?></h3>
                                    <div class="description">
                                        <p><?php the_sub_field('teksti'); ?></p>
                                    </div>
                                    <a class="button" href="<?php echo get_post_type_archive_link( $post_type_object->name ); ?>">kaikki <?php echo strtolower($post_type_object->label); ?></a>
                                </div>
                                <div class="right">
                                    <img class="kuva" src="<?php $img = wp_get_attachment_image_src( get_sub_field('kuva'), 'medium' ); echo $img[0]; ?>" />
                                </div>
                            </div>
                        </section>

                    <?php $n++; endif;

                endwhile;

            else :

            // no layouts found

            endif;

            ?>

            <?php while ( have_posts() ) : the_post(); ?>

            <section class="content">
                <div>
                    <?php the_content(); ?>
                </div>
            </section>

            <?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
