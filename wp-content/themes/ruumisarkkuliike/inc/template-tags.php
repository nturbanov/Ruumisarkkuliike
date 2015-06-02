<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Honkasen Ruumisarkkuliike
 */

if ( ! function_exists( 'ruumisarkkuliike_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function ruumisarkkuliike_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'ruumisarkkuliike' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'ruumisarkkuliike' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'ruumisarkkuliike' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'ruumisarkkuliike_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function ruumisarkkuliike_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'ruumisarkkuliike' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'ruumisarkkuliike' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'ruumisarkkuliike' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'ruumisarkkuliike_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function ruumisarkkuliike_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'ruumisarkkuliike' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'ruumisarkkuliike' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'ruumisarkkuliike_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function ruumisarkkuliike_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'ruumisarkkuliike' ) );
		if ( $categories_list && ruumisarkkuliike_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'ruumisarkkuliike' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'ruumisarkkuliike' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'ruumisarkkuliike' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'ruumisarkkuliike' ), __( '1 Comment', 'ruumisarkkuliike' ), __( '% Comments', 'ruumisarkkuliike' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'ruumisarkkuliike' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function ruumisarkkuliike_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'ruumisarkkuliike_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'ruumisarkkuliike_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so ruumisarkkuliike_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so ruumisarkkuliike_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in ruumisarkkuliike_categorized_blog.
 */
function ruumisarkkuliike_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'ruumisarkkuliike_categories' );
}
add_action( 'edit_category', 'ruumisarkkuliike_category_transient_flusher' );
add_action( 'save_post',     'ruumisarkkuliike_category_transient_flusher' );


/*
 * Replacement for get_adjacent_post()
 *
 * This supports only the custom post types you identify and does not
 * look at categories anymore. This allows you to go from one custom post type
 * to another which was not possible with the default get_adjacent_post().
 * Orig: wp-includes/link-template.php
 *
 * @param string $direction: Can be either 'prev' or 'next'
 * @param multi $post_types: Can be a string or an array of strings
 * http://stackoverflow.com/questions/10376891/make-get-adjacent-post-work-across-custom-post-types
 */
function mod_get_adjacent_post($direction = 'prev', $post_types = 'post') {
    global $post, $wpdb;

    if(empty($post)) return NULL;
    if(!$post_types) return NULL;

    if(is_array($post_types)){
        $txt = '';
        for($i = 0; $i <= count($post_types) - 1; $i++){
            $txt .= "'".$post_types[$i]."'";
            if($i != count($post_types) - 1) $txt .= ', ';
        }
        $post_types = $txt;
    }

    $current_post_date = $post->post_date;

    $join = '';
    $in_same_cat = FALSE;
    $excluded_categories = '';
    $adjacent = $direction == 'prev' ? 'previous' : 'next';
    $op = $direction == 'prev' ? '<' : '>';
    $order = $direction == 'prev' ? 'DESC' : 'ASC';

    // select p.* from wp_posts p join wp_term_relationships r on r.object_id = p.id join wp_term_taxonomy t on t.term_taxonomy_id = r.term_taxonomy_id and t.taxonomy = 'sarjat' join wp_terms s on s.term_id = t.term_id and s.name = (select s2.name from wp_posts p2 join wp_term_relationships r2 on r2.object_id = p2.id join wp_term_taxonomy t2 on t2.term_taxonomy_id = r2.term_taxonomy_id and t2.taxonomy = 'sarjat' join wp_terms s2 on s2.term_id = t2.term_id where p2.id = 121) where r.object_id <> 121 order by p.menu_order


    $join  = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_cat, $excluded_categories );
    $where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type IN({$post_types}) AND p.post_status = 'publish'", $current_post_date), $in_same_cat, $excluded_categories );
    $sort  = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );

    $query = "SELECT p.* FROM $wpdb->posts AS p $join $where $sort";
    $query_key = 'adjacent_post_' . md5($query);
    $result = wp_cache_get($query_key, 'counts');
    if ( false !== $result )
        return $result;

    $result = $wpdb->get_row("SELECT p.* FROM $wpdb->posts AS p $join $where $sort");
    if ( null === $result )
        $result = '';

    wp_cache_set($query_key, $result, 'counts');
    return $result;
}

function cpt_nosto($cpt) {
    var_dump($term);
    var_dump($taxonomy);
    $sarja = get_term_by( 'slug', $term, $taxonomy );
    var_dump($sarja);
?>
    <section class="kuvallinen-nosto">
        <a href="<?php echo get_term_link( $term, $taxonomy ); ?>"
        <h2><?php echo $sarja->name; ?></h2>
        <div class="description">
            <p><?php echo $sarja->description; ?></p>
        </div>
        </a>
    </section>
<?php
}
