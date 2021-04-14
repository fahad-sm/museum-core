<?php

// wp_enqueue_script(['lightbox']);

$allowed_html = wp_kses_allowed_html( 'post' );
$qry_args = array(
	'post_type'	=>	'museumwp_gallery',
	'posts_per_page'	=>	$posts_num,
	'order'			=> $sort,
	'orderby'		=> $orderby
);

if($tags) {
	$qry_args['tax_query'] = array(
		array('taxonomy' => 'gallery-tags', 'field' => 'slugs', 'terms' => $tags)
	);
}
$col_class = ($columns == 4) ? 'col-sm-3' : 'col-sm-4';
// The Query
$qry = new WP_Query( $qry_args );
?>


<?php if ( $qry->have_posts() ) :
	?>
	<div class="gallery">
		<ul class="row">
			<?php
			$i = 1;
			while( $qry->have_posts() ) : $qry->the_post();
				?>
				<li class="<?php echo esc_attr($col_class) ?>">
					<div class="inn-sec">

						<?php echo get_the_term_list( get_the_ID(), 'gallery-tags' ); ?>

						<div class="hover-info">
							<div class="position-center-center">
								<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>" data-rel="prettyPhoto" class="prettyPhoto lightzoom zoom">
									<i class="fa fa-image"></i>
								</a>
							</div>
						</div>
						<?php the_post_thumbnail("museumwp-360-278"); ?>
						<div class="detail">
							<a href="<?php echo esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_title(); ?>
							</a>
							<p><span><?php esc_html_e("Origin: ", "museum-core"); ?></span><?php echo esc_attr( get_field( 'museumwp_cf_origin' ) ); ?></p>
						</div>
					</div>
				</li>
				<?php
				if( $i % 3 == 0 ) {
					?>
					<li class="clearfix"></li>
					<?php
				}
				$i++;
			endwhile;

			// Restore original Post Data
			wp_reset_postdata();
			?>
		</ul>
	</div>
	<?php
endif;
?>
