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
<div id="blog-section" class="blog-section ow-section">

	<div class="container">
		<div class="row">
			<div class="section-header">
				<h3><?php echo esc_attr($title) ?></h3>
			</div>

			<?php

			if( $query->have_posts() ) :

				while ( $query->have_posts() ) : $query->the_post();

					if( ! has_post_thumbnail() ) {
						$thumb_css = "not-hasthumbnail ";
					}
					else {
						$thumb_css = "";
					}

					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( $thumb_css . 'col-md-6 col-sm-12'); ?>>
						<div class="blog-box">
							<div class="blog-box-inner">
								<header class="entry-header">
									<h3><a title="Blog Title" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3>
								</header>
								<footer class="entry-meta">

									<div class="byline">
										<span class="author">
											<?php esc_html_e("BY ", 'museum-core'); ?>
											<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="url fn n">
												<?php echo get_the_author(); ?><?php esc_html_e(",", "museum-core"); ?>
											</a>
										</span>
									</div>

									<div class="postlike">
										<div class="like"><?php //echo get_simple_likes_button( get_the_ID() ); ?></div>
									</div>

								</footer>
								
								<div class="entry-content">
									<p><?php echo wp_trim_words( get_the_excerpt(), 12, ''); ?></p>
								</div>
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more-post">
									<?php echo esc_html_e( 'Read More...', 'museum-core' ); ?>
								</a>
							</div>
							<div class="entry-cover pull-right">
								<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('museumwp_278_298'); ?></a>
								<div class="posted-on">
									<div class="like"><?php //echo get_simple_likes_button( get_the_ID() ); ?></div>
									<span class="date"><?php echo get_the_date( 'n M', get_the_ID() ); ?></span>
								</div>
							</div>
						</div>
					</article>
					<?php
				endwhile;
				
			endif; 
			?>
		</div>
		<?php if( $enable_more_btn && $btn_url['url'] ) : ?>
			<div class="text-center">
				<a href="<?php echo esc_url($btn_url['url']) ?>" class="btn view-all-posts"><?php echo esc_attr($btn) ?></a>
			</div>
		<?php endif;  ?>
	</div>
</div>

<?php wp_reset_postdata() ?>