<div class="share">
<?php //echo get_permalink(); ?>
    <div class="share-button">
        <ul class="soc">
            <li><a target="_blank" class="soc-facebook" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>"></a></li>
            <li><a target="_blank" class="soc-twitter" href="http://twitter.com/home?status=<?php echo get_permalink(); ?>"></a></li>
            <li><a target="_blank" class="soc-google soc-icon-last" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"></a></li>
        </ul>
        <span><i class="fa fa-share-alt"></i> Jaa linkki</span>
        </div>
    <a href="mailto:?body=<?php echo get_permalink(); ?>"><i class="fa fa-envelope-o"></i> Lähetä sähköpostilla ystävälle</a>
</div><!-- .share -->