<?php
/**
 * Lyrico Customizer Custom Controls
 *
 * @package Lyrico
 * @since 1.0.0
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Simple Notice Custom Control
	 */
	class Lyrico_Header_In_Section extends WP_Customize_Control {
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>



<div class="lyrico-heading-in-section">
			<?php if ( ! empty( $this->label ) ) { ?>
	<h2 class="lyrico-customize-control-title"><?php echo esc_html( $this->label ); ?></h2>

	<?php } ?>
			<?php if ( ! empty( $this->description ) ) { ?>
	<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
	<?php } ?>
</div>



			<?php
		}
	}
	/**
	 * Simple Notice Custom Control
	 */
	class Lyrico_Description_With_Image extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'image_description';

		/**
		 * Add support for image url.
		 */
		public $image;

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>



	<div class="lyrico-description-with-image">
		<span class="dashicons dashicons-info"></span>
			<?php if ( ! empty( $this->image ) ) { ?>
				<img src="<?php echo esc_url( $this->image ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $this->image_title ); ?>">
			<?php } ?>

			<?php if ( ! empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php } ?>
	</div>



			<?php
		}
	}

	/**
	 * Slider Custom Control With Responsive
	 */
	class Lyrico_Slider_Custom_Control_With_Responsive extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 *
		 * @var string
		 */
		public $type = 'lyrico_range_control';

		/**
		 * The type of control being rendered
		 *
		 * @var bool
		 */
		public $has_responsive;

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="lyrico-device-select-tabs">
				<ul>
					<li><a title="<?php echo esc_attr( 'Devices Bigger Than Tablets', 'lyrico' ); ?>" class="lyrico-device-select-button dashicons dashicons-desktop" href="#customize-control-<?php echo esc_attr( $this->id ); ?>"></a></li>
					<li><a title="<?php echo esc_attr( 'Tablets', 'lyrico' ); ?>" class="lyrico-device-select-button dashicons dashicons-tablet" href="#customize-control-<?php echo esc_attr( $this->id ); ?>_tablet"></a></li>
					<li><a title="<?php echo esc_attr( 'Mobile Devices', 'lyrico' ); ?>" class="lyrico-device-select-button dashicons dashicons-smartphone" href="#customize-control-<?php echo esc_attr( $this->id ); ?>_mobile"></a></li>
				</ul>

				<div id="customize-control-<?php echo esc_attr( $this->id ); ?>" class="slider-custom-control">
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

					<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php endif; ?>

					<input type="number" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value( 'other_devices' ) ); ?>" class="customize-control-slider-value" <?php $this->link( 'other_devices' ); ?> />
					<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div>
					<span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
				</div>

				<div id="customize-control-<?php echo esc_attr( $this->id ); ?>_tablet" class="slider-custom-control">
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?> (Tablets)</span>

					<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php endif; ?>

					<input type="number" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value( 'tablets' ) ); ?>" class="customize-control-slider-value" <?php $this->link( 'tablets' ); ?> />
					<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div>
					<span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
				</div>

				<div id="customize-control-<?php echo esc_attr( $this->id ); ?>_mobile" class="slider-custom-control">
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?> (Mobile Devices)</span>

					<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php endif; ?>

					<input type="number" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value( 'mobile_devices' ) ); ?>" class="customize-control-slider-value" <?php $this->link( 'mobile_devices' ); ?> />
					<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div>
					<span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Custom Control Base Class
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Skyrocket_Custom_Control extends WP_Customize_Control {
		/**
		 * Return The Directory
		 */
		protected function get_skyrocket_resource_url() {
			if ( strpos( wp_normalize_path( __DIR__ ), wp_normalize_path( WP_PLUGIN_DIR ) ) === 0 ) {
				// We're in a plugin directory and need to determine the url accordingly.
				return plugin_dir_url( __DIR__ );
			}

			return trailingslashit( get_template_directory_uri() );
		}
	}

	/**
	 * Image Radio Button Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Skyrocket_Image_Radio_Button_Custom_Control extends Skyrocket_Custom_Control {
		/**
		 * The type of control being rendered
		 *
		 * @var string
		 */
		public $type = 'image_radio_button';

		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'skyrocket-custom-controls-css', $this->get_skyrocket_resource_url() . 'assets/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="image_radio_button_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

				<?php foreach ( $this->choices as $key => $value ) { ?>
					<label class="radio-button-label">
						<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
						<img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
					</label>
				<?php	} ?>
			</div>
			<?php
		}
	}

	/**
	 * Slider Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Skyrocket_Slider_Custom_Control extends Skyrocket_Custom_Control {
		/**
		 * The type of control being rendered
		 *
		 * @var string
		 */
		public $type = 'slider_control';

		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket-custom-controls-js', $this->get_skyrocket_resource_url() . 'assets/js/customizer.js', array( 'jquery', 'jquery-ui-core' ), '1.0', true );
			wp_enqueue_style( 'skyrocket-custom-controls-css', $this->get_skyrocket_resource_url() . 'assets/css/customizer.css', array(), '1.0', 'all' );
		}

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="slider-custom-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
				<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div>
				<span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
			</div>
			<?php
		}
	}

	/**
	 * Toggle Switch Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Skyrocket_Toggle_Switch_Custom_Control extends Skyrocket_Custom_Control {
		/**
		 * The type of control being rendered
		 *
		 * @var string
		 */
		public $type = 'toggle_switch';

		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'skyrocket-custom-controls-css', $this->get_skyrocket_resource_url() . 'assets/css/customizer.css', array(), '1.0', 'all' );
		}

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>"
															<?php
															$this->link();
															checked( $this->value() );
															?>
					>
					<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
			<?php
		}
	}

	/**
	 * Google Font Select Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Skyrocket_Google_Font_Select_Custom_Control extends Skyrocket_Custom_Control {
		/**
		 * The type of control being rendered
		 *
		 * @var string
		 */
		public $type = 'google_fonts';

		/**
		 * The list of Google Fonts
		 *
		 * @var bool
		 */
		private $font_list = false;

		/**
		 * The saved font values decoded from json
		 *
		 * @var array
		 */
		private $font_values = [];

		/**
		 * The index of the saved font within the list of Google fonts
		 *
		 * @var int
		 */
		private $font_list_index = 0;

		/**
		 * The number of fonts to display from the json file. Either positive integer or 'all'. Default = 'all'
		 *
		 * @var string
		 */
		private $font_count = 'all';

		/**
		 * The font list sort order. Either 'alpha' or 'popular'. Default = 'alpha'
		 *
		 * @var string
		 */
		private $font_order_by = 'alpha';

		/**
		 * Get our list of fonts from the json file
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Get the font sort order.
			if ( isset( $this->input_attrs['orderby'] ) && strtolower( $this->input_attrs['orderby'] ) === 'popular' ) {
				$this->font_order_by = 'popular';
			}
			// Get the list of Google fonts.
			if ( isset( $this->input_attrs['font_count'] ) ) {
				if ( 'all' !== strtolower( $this->input_attrs['font_count'] ) ) {
					$this->font_count = ( abs( (int) $this->input_attrs['font_count'] ) > 0 ? abs( (int) $this->input_attrs['font_count'] ) : 'all' );
				}
			}
			$this->font_list = $this->skyrocket_getGoogleFonts( 'all' );

			// Decode the default json font value.
			$this->font_values = json_decode( $this->value() );

			// Find the index of our default font within our list of Google fonts.
			$this->font_list_index = $this->skyrocket_getFontIndex( $this->font_list, $this->font_values->font );
		}
		/**
		 * Enqueue our scripts and styles.
		 */
		public function enqueue() {
			wp_enqueue_script( 'lyrico-select2-js', get_template_directory_uri() . '/assets/js/select2.min.js', array( 'jquery' ), '4.0.6', true );
			wp_enqueue_script( 'lyrico-custom-controls-js', get_template_directory_uri() . '/assets/js/customizer.js', array( 'lyrico-select2-js' ), '1.0', true );
			wp_enqueue_style( 'lyrico-custom-controls-css', get_template_directory_uri() . '/assets/css/customizer.css', array(), '1.1', 'all' );
			wp_enqueue_style( 'lyrico-select2-css', get_template_directory_uri() . '/assets/css/select2.min.css', array(), '4.0.6', 'all' );
		}
		/**
		 * Export our List of Google Fonts to JavaScript
		 */
		public function to_json() {
			parent::to_json();
			$this->json['skyrocketfontslist'] = $this->font_list;
		}
		/**
		 * Render the control in the customizer.
		 */
		public function render_content() {
			$font_counter    = 0;
			$is_font_in_list = false;
			$font_list_str   = '';

			if ( ! empty( $this->font_list ) ) {
				?>
				<div class="google_fonts_select_control">
					<?php if ( ! empty( $this->label ) ) { ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php } ?>
					<?php if ( ! empty( $this->description ) ) { ?>
						<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php } ?>
					<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-google-font-selection" <?php $this->link(); ?> />
					<div class="google-fonts">
						<select class="google-fonts-list" control-name="<?php echo esc_attr( $this->id ); ?>">
							<?php
							foreach ( $this->font_list as $key => $value ) {
								$font_counter++;
								$font_list_str .= '<option value="' . $value->family . '" ' . selected( $this->font_values->font, $value->family, false ) . '>' . $value->family . '</option>';
								if ( $this->font_values->font === $value->family ) {
									$is_font_in_list = true;
								}
								if ( is_int( $this->font_count ) && $font_counter === $this->font_count ) {
									break;
								}
							}
							if ( ! $is_font_in_list && $this->font_list_index ) {
								// If the default or saved font value isn't in the list of displayed fonts, add it to the top of the list as the default font.
								$font_list_str = '<option value="' . $this->font_list[ $this->font_list_index ]->family . '" ' . selected( $this->font_values->font, $this->font_list[ $this->font_list_index ]->family, false ) . '>' . $this->font_list[ $this->font_list_index ]->family . ' (default)</option>' . $font_list_str;
							}
								// Display our list of font options.
								echo $font_list_str; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
						</select>
					</div>
					<div class="customize-control-description"><?php esc_html_e( 'Select weight for the Page Title.', 'lyrico' ); ?></div>
					<div class="weight-style">
						<select class="google-fonts-thinweight-style">
							<?php
							foreach ( $this->font_list[ $this->font_list_index ]->variants as $key => $value ) {
								// Only add options that aren't italic.
								if ( strpos( $value, 'italic' ) === false ) {
									echo '<option value="' . esc_attr( $value ) . '" ' . selected( $this->font_values->thinweight, $value, false ) . '>' . esc_html( $value ) . '</option>';
									$option_count++;
								}
							}
							?>
						</select>
					</div>
					<div class="customize-control-description"><?php esc_html_e( 'Select weight for regular text (Recommended: regular).', 'lyrico' ); ?></div>
					<div class="weight-style">
						<select class="google-fonts-regularweight-style">
							<?php
							foreach ( $this->font_list[ $this->font_list_index ]->variants as $key => $value ) {
								// Only add options that aren't italic.
								if ( strpos( $value, 'italic' ) === false ) {
									echo '<option value="' . esc_attr( $value ) . '" ' . selected( $this->font_values->regularweight, $value, false ) . '>' . esc_html( $value ) . '</option>';
									$option_count++;
								}
							}
							?>
						</select>
					</div>
					<div class="customize-control-description"><?php esc_html_e( 'Select weight for bold text (Recommended: 500, 600).', 'lyrico' ); ?></div>
					<div class="weight-style">
						<select class="google-fonts-boldweight-style">
							<?php
							foreach ( $this->font_list[ $this->font_list_index ]->variants as $key => $value ) {
								// Only add options that aren't italic.
								if ( strpos( $value, 'italic' ) === false ) {
									echo '<option value="' . esc_attr( $value ) . '" ' . selected( $this->font_values->boldweight, $value, false ) . '>' . esc_html( $value ) . '</option>';
									$option_count++;
								}
							}
							?>
						</select>
					</div>
					<input type="hidden" class="google-fonts-category" value="<?php echo esc_attr( $this->font_values->category ); ?>">
				</div>
				<?php
			}
		}

		/**
		 * Find the index of the saved font in our multidimensional array of Google Fonts
		 */
		public function skyrocket_getFontIndex( $haystack, $needle ) {
			foreach ( $haystack as $key => $value ) {
				if ( $value->family === $needle ) {
					return $key;
				}
			}
			return false;
		}

		/**
		 * Return the list of Google Fonts from our json file. Unless otherwise specfied, list will be limited to 30 fonts.
		 */
		public function skyrocket_getGoogleFonts( $count = 30 ) {
			// Google Fonts json generated from https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=YOUR-API-KEY.
			$font_file = $this->get_skyrocket_resource_url() . 'assets/popular-fonts.json';
			if ( 'popular' === $this->font_order_by ) {
				$font_file = $this->get_skyrocket_resource_url() . 'assets/popular-fonts.json';
			}

			$request = wp_remote_get( $font_file );
			if ( is_wp_error( $request ) ) {
				return '';
			}

			$body    = wp_remote_retrieve_body( $request );
			$content = json_decode( $body );

			if ( 'all' === $count ) {
				return $content->items;
			} else {
				return array_slice( $content->items, 0, $count );
			}
		}
	}
	/**
	 * URL sanitization
	 *
	 * @param  string   Input to be sanitized (either a string containing a single url or multiple, separated by commas)
	 * @return string   Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_url_sanitization' ) ) {
		function skyrocket_url_sanitization( $input ) {
			if ( strpos( $input, ',' ) !== false ) {
				$input = explode( ',', $input );
			}
			if ( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[ $key ] = esc_url_raw( $value );
				}
				$input = implode( ',', $input );
			} else {
				$input = esc_url_raw( $input );
			}
			return $input;
		}
	}

	/**
	 * Switch sanitization
	 *
	 * @param  string       Switch value
	 * @return integer  Sanitized value
	 */
	if ( ! function_exists( 'skyrocket_switch_sanitization' ) ) {
		function skyrocket_switch_sanitization( $input ) {
			if ( true === $input ) {
				return 1;
			} else {
				return 0;
			}
		}
	}

	/**
	 * Radio Button and Select sanitization
	 *
	 * @param  string       Radio Button value
	 * @return integer  Sanitized value
	 */
	if ( ! function_exists( 'skyrocket_radio_sanitization' ) ) {
		function skyrocket_radio_sanitization( $input, $setting ) {
			// get the list of possible radio box or select options.
			$choices = $setting->manager->get_control( $setting->id )->choices;

			if ( array_key_exists( $input, $choices ) ) {
				return $input;
			} else {
				return $setting->default;
			}
		}
	}

	/**
	 * Integer sanitization
	 *
	 * @param  string       Input value to check
	 * @return integer  Returned integer value
	 */
	if ( ! function_exists( 'skyrocket_sanitize_integer' ) ) {
		function skyrocket_sanitize_integer( $input ) {
			return (int) $input;
		}
	}

	/**
	 * Text sanitization
	 *
	 * @param  string   Input to be sanitized (either a string containing a single string or multiple, separated by commas)
	 * @return string   Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_text_sanitization' ) ) {
		function skyrocket_text_sanitization( $input ) {
			if ( strpos( $input, ',' ) !== false ) {
				$input = explode( ',', $input );
			}
			if ( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[ $key ] = sanitize_text_field( $value );
				}
				$input = implode( ',', $input );
			} else {
				$input = sanitize_text_field( $input );
			}
			return $input;
		}
	}

	/**
	 * Array sanitization
	 *
	 * @param  array    Input to be sanitized
	 * @return array    Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_array_sanitization' ) ) {
		function skyrocket_array_sanitization( $input ) {
			if ( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[ $key ] = sanitize_text_field( $value );
				}
			} else {
				$input = '';
			}
			return $input;
		}
	}

	/**
	 * Only allow values between a certain minimum & maxmium range
	 *
	 * @param  number   Input to be sanitized
	 * @return number   Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_in_range' ) ) {
		function skyrocket_in_range( $input, $min, $max ) {
			if ( $input < $min ) {
				$input = $min;
			}
			if ( $input > $max ) {
				$input = $max;
			}
			return $input;
		}
	}

	/**
	 * Google Font sanitization
	 *
	 * @param  string   JSON string to be sanitized
	 * @return string   Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_google_font_sanitization' ) ) {
		function skyrocket_google_font_sanitization( $input ) {
			$val = json_decode( $input, true );
			if ( is_array( $val ) ) {
				foreach ( $val as $key => $value ) {
					$val[ $key ] = sanitize_text_field( $value );
				}
				$input = wp_json_encode( $val );
			} else {
				$input = wp_json_encode( sanitize_text_field( $val ) );
			}
			return $input;
		}
	}

	/**
	 * Slider sanitization
	 *
	 * @param  string   Slider value to be sanitized
	 * @return string   Sanitized input
	 */
	if ( ! function_exists( 'skyrocket_range_sanitization' ) ) {
		function skyrocket_range_sanitization( $input, $setting ) {
			$attrs = $setting->manager->get_control( $setting->id )->input_attrs;

			$min  = ( isset( $attrs['min'] ) ? $attrs['min'] : $input );
			$max  = ( isset( $attrs['max'] ) ? $attrs['max'] : $input );
			$step = ( isset( $attrs['step'] ) ? $attrs['step'] : 1 );

			$number = floor( $input / $attrs['step'] ) * $attrs['step'];

			return skyrocket_in_range( $number, $min, $max );
		}
	}
}
