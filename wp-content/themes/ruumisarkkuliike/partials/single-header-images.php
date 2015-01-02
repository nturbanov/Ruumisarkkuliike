<?php
$images = get_field( 'kuvakaruselli' );
if ($images) : ?>

<ul class="rslides">
<?php foreach ($images as $image) : ?>
    <li><a href="<?php echo $image['kuva']['url']; ?>"><?php echo wp_get_attachment_image( $image['kuva']['ID'], 'large' ); ?></a></li>
<?php endforeach; ?>
</ul>

<?php elseif ( has_post_thumbnail() ) : $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>

    <a href="<?php echo $full_image_url[0] ?>" title="<?php the_title_attribute( 'echo=0' ) ?>">
    <?php the_post_thumbnail( 'large' ); ?>
    </a>

<?php endif; ?>