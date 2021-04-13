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
					<div class="hrs section-header">
						<h3 ><i class="ion-ios-clock-outline"></i><?php echo $settings['Heading']?></h3>							
						<ul>
									<li class="col-md-5 no-padding section-time">
										<h5><?php echo $item['days'] ?></h5>
										<p class="time"><?php echo $item['time'] ?></p>
									</li>
									<li class="col-md-7 no-padding section-appointment">
										<span class="appoiment"><?php echo $item['text'] ?></span>
									</li>
								</ul>
														
								
													</div>
				</div>

<?php wp_reset_postdata() ?>