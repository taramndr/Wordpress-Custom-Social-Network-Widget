<?php
/**
 * @package Social Widget
 */

class my_social_widget extends WP_Widget { 

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'my_social_widget', // Base ID
			'Social Network Widget', // Name

			array( 'description' => __( 'A widget to add url of your social network.', 'mytheme' ), ) // Args
			);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$name = apply_filters( 'widget_name', $instance['name'] );
		
		$fb_link = apply_filters( 'widget_fb_link', $instance['fb_link'] );
		$twt_link= apply_filters( 'widget_twt_link', $instance['twt_link'] );
		$yt_link = apply_filters( 'widget_yt_link', $instance['yt_link'] );

		echo $before_widget;

		if ( ! empty( $instance['name'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['name'] ). $args['after_title'];
		}
		?>

		<div class="your_class_name">

			<ul>
				<li><a href="<?php echo esc_url($instance['fb_link']); ?>"><i class="fa fa-fa-facebook">FB</i></a></li>
				<li><a href="<?php echo esc_url($instance['twt_link']); ?>"><i class="fa fa-fa-twitter">TWT</i></a></li>
				<li><a href="<?php echo esc_url($instance['yt_link']); ?>"><i class="fa fa-fa-youtube">YT</i></a></li>
			</ul>
			
		</div>

		<?php
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : '';
		$instance['fb_link'] = ( ! empty( $new_instance['fb_link'] ) ) ? strip_tags( $new_instance['fb_link'] ) : '';
		$instance['twt_link'] = ( ! empty( $new_instance['twt_link'] ) ) ? $new_instance['twt_link'] : '';
		$instance['yt_link'] = ( ! empty( $new_instance['yt_link'] ) ) ? strip_tags( $new_instance['yt_link'] ) : '';
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'name' ] ) ) {
			$name = $instance[ 'name' ];
		}
		else {
			$name = __( '', 'mytheme' );
		}

		if ( isset( $instance[ 'fb_link' ] ) ) {
			$fb_link = $instance[ 'fb_link' ];
		}
		else {
			$fb_link = __( '', 'mytheme' );
		}

		if ( isset( $instance[ 'twt_link' ] ) ) {
			$twt_link = $instance[ 'twt_link' ];
		}
		else {
			$twt_link = __( '', 'mytheme' );
		}

		if ( isset( $instance[ 'yt_link' ] ) ) {
			$yt_link = $instance[ 'yt_link' ];
		}
		else {
			$yt_link = __( '', 'mytheme' );
		} 
		?>

		<p>
			<label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Title', 'mytheme'); ?></label><br />
			<input type="text" name="<?php echo $this->get_field_name('name'); ?>" id="<?php echo $this->get_field_id('name'); ?>" value="<?php echo $name; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('fb_link'); ?>">Facebook Link</label><br />
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('fb_link'); ?>" id="<?php echo $this->get_field_id('fb_link'); ?>" value="<?php echo $fb_link; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('twt_link'); ?>">Twitter Link</label><br />
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('twt_link'); ?>" id="<?php echo $this->get_field_id('twt_link'); ?>" value="<?php echo $twt_link; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('yt_link'); ?>">Youtube Link</label><br />
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('yt_link'); ?>" id="<?php echo $this->get_field_id('yt_link'); ?>" value="<?php echo $yt_link; ?>">
		</p>
		

		<?php 
	}
	
}
add_action( 'widgets_init', create_function( '', 'register_widget( "my_social_widget" );' ) );
