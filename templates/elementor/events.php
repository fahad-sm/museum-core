<?php
$title = $desc = '';
$args = array(
	'post_type'	=> 'tribe_events',
	'posts_per_page' => $posts_num,
	'offset'	=> $posts_offset
);

if($is_manual_selection === 'yes') {
	$args['post__in'] = $manual_selection;
}else if($is_manual_selection === 'recent') {
	$args['order'] = $sort;
	$args['orderby'] = $orderby;
} else {
	if($posts_cats) {
		$args['tax_query'] = array(
			array('taxonomy' => 'tribe_events_cat', 'field' => 'slug', 'terms' => $posts_cats)
		);
	}
}

$qry = new WP_Query($args);

if( $column == 'one' ) {
	include get_theme_file_path( 'template-parts/events-1.php' );
}
else if( $column == "two" ) {
	include get_theme_file_path( 'template-parts/events-2.php' );
}
// Restore original Post Data
wp_reset_postdata();