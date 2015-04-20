<?php
$images = get_field( 'kuvakaruselli' );
if ($images) : ?>

<ul class="rslides">
<?php foreach ($images as $image) : ?>
    <li>
        <a rel="gallery" class="swipebox" title="<?php echo $image['kuva']['title']; ?>" href="<?php echo $image['kuva']['url']; ?>">
            <img src="<?php echo $image['kuva']['sizes']['large']; ?>" title="<?php echo $image['kuva']['title']; ?>" alt="<?php echo $image['kuva']['alt'].' '.$image['kuva']['description']; ?>" width="<?php echo $image['kuva']['sizes']['large-width']; ?>" height="<?php echo $image['kuva']['sizes']['large-height']; ?>" />
        </a>
    </li>
<?php endforeach; ?>
</ul>

<?php elseif ( has_post_thumbnail() ) : $image = wp_get_attachment( get_post_thumbnail_id() ); ?>

    <a class="swipebox" title="<?php echo $image['title']; ?>" href="<?php echo $image['src']; ?>">
        <img src="<?php echo $image['src']; ?>" title="<?php echo $image['title']; ?>" alt="<?php echo $image['alt'].' '.$image['caption']; ?>" />
    </a>

<?php endif; ?>