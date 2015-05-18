<section class="suunnittelijan-sarjat">

    <div class="row">

        <h3>Suunnittelijan mallistot</h3>

        <?php

        $terms = wp_get_post_terms( $post->ID, 'sarjat' );

        foreach ( $terms as $term ) : ?>

            <article>
                <a href="<?php echo get_term_link( $term, 'sarjat' ); ?>">
                <?php $term_image = get_field('sarjan_kuva', $term); ?>
                        <img src="<?php echo $term_image['sizes']['large']; ?>" title="<?php echo $term_image['title']; ?>" alt="<?php echo $term_image['alt'].' '.$term_image['description']; ?>" width="<?php echo $term_image['sizes']['large-width']; ?>" height="<?php echo $term_image['sizes']['large-height']; ?>" />
                <h1 class="entry-title"><?php echo $term->name; ?></h1>
                </a>
            </article>

        <?php endforeach; ?>

    </div>

</section><!-- .muut -->