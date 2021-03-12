<?php
wp_enqueue_script(array('owl-carousel', 'services_scripts'));
wp_enqueue_style(array('owl-carousel', 'services_style', 'responsive_services_style'));

$args = array(
    'post_type'     => 'service',
    'posts_per_page'    => $settings['query_number'],
    'order'         => $settings['query_order'],
    'orderby'       => $settings['query_orderby'],
);

$query = new WP_Query($args);

if( ! $query->have_posts() ) {
    return;
}

$title_limit = $settings['title_limit'] ? $settings['title_limit'] : 10;


$this->add_render_attribute('wrapper', 'class', 'service-wrap');
$this->add_render_attribute('wrapper', 'id', 'service-wrap');
$this->add_render_attribute('row', 'class', 'row');

?>
<div  <?php echo $this->get_render_attribute_string('wrapper') ?>>
	<div  <?php echo $this->get_render_attribute_string('row') ?>>	
    	<div class="col-lg-12">
            <div class="services-slider owl-carousel">
                <?php while($query->have_posts() ) : $query->the_post() ?>
                    <div class="service-item-style1">
                        <div class="service-img">
                            <figure>
                                <?php echo wp_kses_post( webinane_el_resizer()->resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'full' ), 350, 390, true ) ); ?>
                            </figure>
                            <h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title(), $title_limit, '' ); ?></a></h2>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html($settings['detail-btn'])?></a>            
                        </div>
                   </div> 
                <?php endwhile; ?>
            </div>
		</div>
	</div>
</div>	

