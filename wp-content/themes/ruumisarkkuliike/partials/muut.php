<section class="muut">

    <div class="container">

        <?php if ( is_singular( array( 'verhoillut-arkut', 'puuarkut', 'uurnat' ) ) ) : ?>
            <h2>Katso myös nämä</h2>
        <?php else : ?>
            <h2>Lisää suunnittelijoita</h2>
        <?php endif; ?>

        <div class="row">

        <?php

        $args = array(
            'post_type' => get_post_type(),
            'posts_per_page' => 4,
            'orderby' => 'rand'
            );

        $my_query = new WP_Query( $args );

        // var_dump($my_query); exit;

        // The 2nd Loop
        while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

            <?php
            if ( is_singular( array( 'verhoillut-arkut', 'puuarkut', 'uurnat' ) ) ) {
                get_template_part( 'content', 'archive' );
            }
            else {
                get_template_part( 'content', 'archive-suunnittelijat' );
            }
            ?>

        <?php endwhile; wp_reset_postdata(); ?>

        </div>

    </div>

</section><!-- .muut -->