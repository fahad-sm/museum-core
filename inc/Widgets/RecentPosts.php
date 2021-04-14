<?php
namespace MuseumCore\Widgets;
/**
 * RecentPosts widget class OW
 *
 * @since 2.8.0
 */
class RecentPosts extends \WP_Widget {

	public function __construct() {

		$widget_ops = array( 'classname' => 'widget_recentposts', 'description' => __( "Your site&#8217;s most recent Posts with thumbnail.", "museum-core" ) );

		parent::__construct('widget_recentposts', __('Museum :: Recent Posts with Thumbnail', "museum-core"), $widget_ops);

		$this->alt_option_name = 'widget_recentposts';
	}

	public function widget($args, $instance) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', "museum-core" );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;

		if ( ! $number ) {
			$number = 5;
		}

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$qry_args = array (
			//'post_type'              => 'product',
			'post_status'            => 'publish',
			'posts_per_page'         => $number,
			'ignore_sticky_posts'    => true,
			'order'                  => 'DESC',
			'orderby'                => 'rand',
		);

		$qry = new \WP_Query( $qry_args );

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		<ul class="latest-post">
			<?php
			while ( $qry->have_posts() ) : $qry->the_post();
				?>
				<li>
					<div class="media">
						<div class="media-left">
							<a href="<?php echo esc_url( the_permalink() ); ?>">
								<?php the_post_thumbnail('museumwp-59-59'); ?>
							</a>
						</div>
						<div class="media-body">
							<a href="<?php echo esc_url( the_permalink() ); ?>"><?php the_title(); ?></a>
							<p><?php echo get_the_date( 'M j, Y', get_the_ID() ); ?></p>
						</div>
					</div>
				</li>
				<?php
			endwhile;
			?>
		</ul>
		<?php
		echo $args['after_widget'];

		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	public function form( $instance ) {

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', "museum-core" ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to show:', "museum-core" ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" />
		</p>
		<?php
	}
}
?>