<?php

// extract($settings);

$allowed_html = wp_kses_allowed_html( 'post' );

$qry_args = array(
	'post_type'			=>	"museumwp_clients",
	'posts_per_page'	=>	($posts_num) ? $posts_num : -1,
	'order'				=>	($sort) ? $sort : 'DESC',
	'orderby'			=>	($orderby) ? $orderby : 'date',
);

// The Query
$qry = new WP_Query( $qry_args );


if (! $qry->have_posts() ) {
	return;
}

if( $carousel == "yes" ) {
	include get_theme_file_path( 'template-parts/client-list.php' );
}
else {
	include get_theme_file_path( 'template-parts/client-grid.php' );
}

