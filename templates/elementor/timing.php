<?php 
extract($settings);
$allowed_html = wp_kses_allowed_html( 'post' );

$args = array(
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
		$args['category'] = $posts_cats;
	}
}

$query = new WP_Query($args);
?>
<div class="col-md-5">
					<div class="hrs">
						<h3><i class="ion-ios-clock-outline"></i><?php the_title();?></h3>								<ul>
									<li class="col-md-5 no-padding">
										<h5></h5>
										<p><?php echo get_the_date( 'n M', get_the_ID() ); ?></p>
									</li>
									<li class="col-md-7 no-padding">
										<span class="appoiment">School appoinments </span>
									</li>
								</ul>
																<ul>
									<li class="col-md-5 no-padding">
										<h5>Thu - Sun</h5>
										<p>8:00 Am to 7:00 Pm</p>
									</li>
									<li class="col-md-7 no-padding">
										<span class="appoiment">Tourists appoinments </span>
									</li>
								</ul>
													</div>
				</div>

<?php wp_reset_postdata() ?>