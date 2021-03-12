<?php
namespace MuseumCore\Elementor\Classes\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use Elementor\Base_Data_Control;

/**
 * Elementor imageselect control.
 *
 * A base control for creating imageselect control. Displays a select box control
 * based on imageselect jQuery plugin @see https://imageselect.github.io/ .
 * It accepts an array in which the `key` is the value and the `value` is the
 * option name. Set `multiple` to `true` to allow multiple value selection.
 *
 * @since 1.0.0
 */
class ControlImageSelect extends Base_Data_Control {

	/**
	 * Get imageselect control type.
	 *
	 * Retrieve the control type, in this case `imageselect`.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'imageselect';
	}

	public function enqueue() {
		// Styles
		wp_register_style( 'webinane-control-imageselect', STUDENT_PLUGIN_URL . 'assets/elementor/css/control-imageselect.css' );
		wp_enqueue_style( 'webinane-control-imageselect' );
	}
	/**
	 * Get imageselect control default settings.
	 *
	 * Retrieve the default settings of the imageselect control. Used to return the
	 * default settings while initializing the imageselect control.
	 *
	 * @since 1.8.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'options' => [],
			'multiple' => false,
			// 'imageselectoptions' => [],
		];
	}

	/**
	 * Render imageselect control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<# if ( data.label ) {#>
				<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<# } #>

			<div class="webinane-elementor-control-imageselect-wrapper">

				<# _.each( data.options, function( option_title, option_value ) {
					var value = data.controlValue;
					if ( typeof value == 'string' ) {
						var selected = ( option_value === value ) ? 'checked' : '';
					} else if ( null !== value ) {
						var value = _.values( value );
						var selected = ( -1 !== value.indexOf( option_value ) ) ? 'checked' : '';
					}
					var uniqid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
					  var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
					  return v.toString(16);
					});
					#>
				<label for="{{ uniqid }}" data-hover="{{option_title.hover_url}}">
					<input type="radio" data-setting="{{ data.name }}" name="{{data.name}}" class="webiane-elementor-imageselect" value="{{option_value}}" id="{{uniqid}}" {{ selected }}>
					<img src="{{option_title.url}}" />
					<img src="{{option_title.hover_url}}" class="on-hover" style="display: none;" />
				</label>

				<# } ); #>
			</div>
		</div>
		<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}
}
