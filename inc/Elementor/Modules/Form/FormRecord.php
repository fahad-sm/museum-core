<?php
namespace MuseumCore\Elementor\Modules\Form;

/*use ElementorPro\Classes\Utils;*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class FormRecord {
	protected $sent_data;
	protected $fields;
	protected $form_type;
	protected $form_settings;
	protected $files = [];
	protected $meta = [];
	public $errors = [];
	public $is_success = false;

	const SUCCESS = 'success';
	const ERROR = 'error';
	const FIELD_REQUIRED = 'required_field';
	const INVALID_FORM = 'invalid_form';
	const SERVER_ERROR = 'server_error';
	const SUBSCRIBER_ALREADY_EXISTS = 'subscriber_already_exists';

	public function get_formatted_data( $with_meta = false ) {
		$formatted = [];
		$no_label = __( 'No Label', 'museum-core' );
		$fields = $this->fields;

		if ( $with_meta ) {
			$fields = array_merge( $fields, $this->meta );
		}

		foreach ( $fields as $key => $field ) {
			if ( empty( $field['title'] ) ) {
				$formatted[ $no_label . ' ' . $key ] = $field['value'];
			} else {
				$formatted[ $field['title'] ] = $field['value'];
			}
		}

		return $formatted;
	}

	/**
	 * @param Ajax_Handler $ajax_handler An instance of the ajax handler.
	 *
	 * @return bool
	 */
	public function validate($ajax_handler = '') {
		foreach ( $this->fields as $id => $field ) {
			$field_type = $field['type'];
			if ( ! empty( $field['required'] ) && '' === $field['value'] && 'upload' !== $field_type ) {
				$this->add_error( $id, $this->get_default_message( 'required_field', $this->form_settings ) );
			}

			/**
			 * Elementor form field validation.
			 *
			 * Fires when a single form field is being validated.
			 *
			 * It allows developers to validate individual field types.
			 *
			 * The dynamic portion of the hook name, `$field_type`, refers to the field type.
			 *
			 * @since 2.0.0
			 *
			 * @param array        $field        Form field.
			 * @param Form_Record  $this         An instance of the form record.
			 * @param Ajax_Handler $ajax_handler An instance of the ajax handler.
			 */
			// do_action( "elementor_pro/forms/validation/{$field_type}", $field, $this, $ajax_handler );
		}

		/**
		 * Elementor form validation.
		 *
		 * Fires when form fields are being validated.
		 *
		 * @since 2.0.0
		 *
		 * @param Form_Record  $this         An instance of the form record.
		 * @param Ajax_Handler $ajax_handler An instance of the ajax handler.
		 */
		do_action( 'elementor_pro/forms/validation', $this, $ajax_handler );

		return empty( $ajax_handler->errors );
	}

	public function get_default_messages() {
		return [
			self::SUCCESS => __( 'The form was sent successfully.', 'museum-core' ),
			self::ERROR => __( 'An error occured.', 'museum-core' ),
			self::FIELD_REQUIRED => __( 'This field is required.', 'museum-core' ),
			self::INVALID_FORM => __( 'There\'s something wrong. The form is invalid.', 'museum-core' ),
			self::SERVER_ERROR => __( 'Server error. Form not sent.', 'museum-core' ),
			self::SUBSCRIBER_ALREADY_EXISTS => __( 'Subscriber already exists.', 'museum-core' ),
		];
	}

	public function get_default_message( $id, $settings ) {
		if ( ! empty( $settings['custom_messages'] ) ) {
			$field_id = $id . '_message';
			if ( isset( $settings[ $field_id ] ) ) {
				return $settings[ $field_id ];
			}
		}

		$default_messages = $this->get_default_messages();

		return isset( $default_messages[ $id ] ) ? $default_messages[ $id ] : __( 'Unknown', 'museum-core' );
	}

	public function add_error( $field, $message = '' ) {
		if ( is_array( $field ) ) {
			$this->errors += $field;
		} else {
			$this->errors[ $field ] = $message;
		}

		$this->set_success( false );

		return $this;
	}

	public function set_success( $bool ) {
		$this->is_success = $bool;

		return $this;
	}
	/**
	 * @param Ajax_Handler $ajax_handler An instance of the ajax handler.
	 *
	 */
	public function process_fields( $ajax_handler ) {
		foreach ( $this->fields as $id => $field ) {
			$field_type = $field['type'];

			/**
			 * Elementor form field process.
			 *
			 * Fires when a single form field is being processed.
			 *
			 * It allows developers to process individual field types.
			 *
			 * The dynamic portion of the hook name, `$field_type`, refers to the field type.
			 *
			 * @since 2.0.0
			 *
			 * @param array        $field        Form field.
			 * @param Form_Record  $this         An instance of the form record.
			 * @param Ajax_Handler $ajax_handler An instance of the ajax handler.
			 */
			do_action( "elementor_pro/forms/process/{$field_type}", $field, $this, $ajax_handler );
		}

		/**
		 * Elementor form process.
		 *
		 * Fires when form fields are being processed.
		 *
		 * @since 2.0.0
		 *
		 * @param Form_Record  $this         An instance of the form record.
		 * @param Ajax_Handler $ajax_handler An instance of the ajax handler.
		 */
		do_action( 'elementor_pro/forms/process', $this, $ajax_handler );
	}

	public function get( $property ) {
		if ( isset( $this->{$property} ) ) {
			return $this->{$property};
		}

		return null;
	}

	public function set( $property, $value ) {
		$this->{$property} = $value;
	}

	public function get_form_settings( $setting ) {
		if ( isset( $this->form_settings[ $setting ] ) ) {
			return $this->form_settings[ $setting ];
		}

		return null;
	}

	public function get_field( $args ) {
		return wp_list_filter( $this->fields, $args );
	}

	public function remove_field( $id ) {
		unset( $this->fields[ $id ] );
	}

	public function update_field( $field_id, $property, $value ) {
		if ( ! isset( $this->fields[ $field_id ] ) || ! isset( $this->fields[ $field_id ][ $property ] ) ) {
			return;
		}
		$this->fields[ $field_id ][ $property ] = $value;
	}

	private function set_meta() {

		$form_metadata = student_get($this->form_settings, 'form_metadata');

		if ( empty( $form_metadata ) ) {
			return;
		}

		foreach ( $form_metadata as $metadata_type ) {
			switch ( $metadata_type ) {
				case 'date':
					$this->meta['date'] = [
						'title' => __( 'Date', 'museum-core' ),
						'value' => date_i18n( get_option( 'date_format' ) ),
					];
					break;

				case 'time':
					$this->meta['time'] = [
						'title' => __( 'Time', 'museum-core' ),
						'value' => date_i18n( get_option( 'time_format' ) ),
					];
					break;

				case 'page_url':
					$this->meta['page_url'] = [
						'title' => __( 'Page URL', 'museum-core' ),
						'value' => $_POST['referrer'],
					];
					break;

				case 'user_agent':
					$this->meta['user_agent'] = [
						'title' => __( 'User Agent', 'museum-core' ),
						'value' => $_SERVER['HTTP_USER_AGENT'],
					];
					break;

				case 'remote_ip':
					$this->meta['remote_ip'] = [
						'title' => __( 'Remote IP', 'museum-core' ),
						//'value' => Utils::get_client_ip(),
					];
					break;
				case 'credit':
					$this->meta['credit'] = [
						'title' => __( 'Powered by', 'museum-core' ),
						'value' => __( 'Elementor', 'museum-core' ),
					];
					break;
			}
		}
	}

	private function set_fields() {
		foreach ( $this->form_settings['form_fields'] as $form_field ) {
			$field = [
				'id' => $form_field['custom_id'],
				'type' => student_get($form_field, 'field_type'),
				'title' => student_get($form_field, 'field_label'),
				'value' => '',
				'raw_value' => '',
				'required' => ! empty( $form_field['required'] ),
			];

			if ( 'upload' === $field['type'] ) {
				$field['file_sizes'] = isset( $form_field['file_sizes'] ) ? $form_field['file_sizes'] : '';
				$field['file_types'] = isset( $form_field['file_types'] ) ? $form_field['file_types'] : '';
				$field['max_files'] = isset( $form_field['max_files'] ) ? $form_field['max_files'] : '';
			}

			if ( isset( $this->sent_data[ $form_field['custom_id'] ] ) ) {
				$field['raw_value'] = $this->sent_data[ $form_field['custom_id'] ];

				$value = $field['raw_value'];

				if ( is_array( $value ) ) {
					$value = implode( ', ', $value );
				}

				$field['value'] = $this->sanitize_field( $field, $value );
			}
			$this->fields[ $form_field['custom_id'] ] = $field;
		}
	}

	private function sanitize_field( $field, $value ) {
		$field_type = $field['type'];
		switch ( $field_type ) {
			case 'text':
			case 'password':
			case 'hidden':
			case 'search':
			case 'checkbox':
			case 'radio':
			case 'select':
				$value = sanitize_text_field( $value );
				break;
			case 'url':
				$value = esc_url_raw( $value );
				break;
			case 'textarea':
				$value = sanitize_textarea_field( $value );
				break;
			case 'email':
				$value = sanitize_email( $value );
				break;
			default:
				/**
				 * Sanitize field value.
				 *
				 * Filters the value of the form field for sanitization purpose.
				 *
				 * The dynamic portion of the hook name, `$field_type`, refers to the field type.
				 *
				 * @since 1.0.0
				 *
				 * @param string $value The field value.
				 * @param array  $field The field array.
				 */
				$value = apply_filters( "elementor_pro/forms/sanitize/{$field_type}", $value, $field );
		}

		return $value;
	}

	public function replace_setting_shortcodes( $setting, $urlencode = false ) {
		// Shortcode can be `[field id="fds21fd"]` or `[field title="Email" id="fds21fd"]`, multiple shortcodes are allowed
		return preg_replace_callback( '/(\[field[^]]*id="(\w+)"[^]]*\])/', function( $matches ) use ( $urlencode ) {
			$value = '';

			if ( isset( $this->fields[ $matches[2] ] ) ) {
				$value = $this->fields[ $matches[2] ]['value'];
			}

			if ( $urlencode ) {
				$value = urlencode( $value );
			}
			return $value;
		}, $setting );
	}

	public function add_file( $id, $index, $filename ) {
		if ( ! isset( $this->files[ $id ] ) || ! is_array( $this->files[ $id ] ) ) {
			$this->files[ $id ] = [
				'url' => [],
				'path' => [],
			];
		}
		$this->files[ $id ]['url'][ $index ] = $filename['url'];
		$this->files[ $id ]['path'][ $index ] = $filename['path'];
	}

	public function has_field_type( $type ) {
		foreach ( $this->fields as $id => $field ) {
			if ( $type === $field['field_type'] ) {
				return true;
			}
		}

		return false;
	}

	public function __construct( $sent_data, $form ) {
		$this->form_type = $form['widgetType'];
		$this->form_settings = $form['settings'];
		$this->sent_data = stripslashes_deep( $sent_data );

		$this->set_fields();
		$this->set_meta();
	}
}
