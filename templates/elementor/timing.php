<?php 
extract($settings);
$allowed_html = wp_kses_allowed_html( 'post' );

?>
<div class="about">
	<div class="hrs">
		<h3 class="section-title">
			<?php Elementor\Icons_Manager::render_icon( $settings['Icon'], [ 'aria-hidden' => 'true' ] ); ?>
			<?php echo wp_kses($heading, $allowed_html) ?>
		</h3>

		<?php foreach( $list as $item ) : ?>
			<ul>
				<li class="col-md-5 no-padding section-time">
					<h5 class="timing-days"><?php echo wp_kses($item['days'], $allowed_html) ?></h5>
					<p class="time"><?php echo wp_kses($item['time'], $allowed_html) ?></p>
				</li>
				<li class="col-md-7 no-padding section-appointment">
					<span class="appoiment"><?php echo wp_kses($item['text'], $allowed_html) ?></span>
				</li>
			</ul>
		<?php endforeach; ?>
	</div>
</div>
