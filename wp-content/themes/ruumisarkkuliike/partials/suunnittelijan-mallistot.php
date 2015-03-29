<section class="suunnittelijan-sarjat">

    <div class="row">

        <h3>Suunnittelijan mallistot</h3>

        <?php

        $terms = wp_get_post_terms( $post->ID, 'sarjat' );

        foreach ( $terms as $term ) : ?>

            <article>
                <a href="<?php echo get_term_link( $term, 'sarjat' ); ?>">
                <?php
                $args = array(
                    'posts_per_page'   => 1,
                    'orderby'          => 'rand',
                    'post_type'        => array(
                        'verhoillut-arkut', 'puuarkut', 'uurnat'
                        ),
                    'tax_query'        => array(
                        array(
                            'taxonomy' => 'sarjat',
                            'field'    => 'slug',
                            'terms'    => $term->slug,
                        ),
                    ),
                );
                $post = get_posts( $args );
                echo get_the_post_thumbnail( $post[0]->ID, 'thumbnail' );
                ?>
                <?php echo $term->name; ?>
                </a>
            </article>

        <?php endforeach; ?>

    </div>

</section><!-- .muut -->