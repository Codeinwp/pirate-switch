<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

class Pirate_Switch_General_Repeater extends WP_Customize_Control {

	public $id;
	private $boxtitle = array();
	private $customizer_repeater_image_control = false;
	private $customizer_repeater_color_control = false;
	private $customizer_repeater_text_control = false;
	private $customizer_repeater_link_control = false;



	/*Class constructor*/
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		/*Get options from customizer.php*/
		$this->boxtitle   = __('Pirate Switch','pirate-switch');

		if ( ! empty( $args['pirate_switch_image_control'] ) ) {
			$this->customizer_repeater_image_control = $args['pirate_switch_image_control'];
		}

		if ( ! empty( $args['pirate_switch_color_control'] ) ) {
			$this->customizer_repeater_color_control = $args['pirate_switch_color_control'];
		}

		if ( ! empty( $args['pirate_switch_text_control'] ) ) {
			$this->customizer_repeater_text_control = $args['pirate_switch_text_control'];
		}

		if ( ! empty( $args['pirate_switch_link_control'] ) ) {
			$this->customizer_repeater_link_control = $args['pirate_switch_link_control'];
		}

		if ( ! empty( $args['id'] ) ) {
			$this->id = $id;
		}
	}

	/*Enqueue resources for the control*/
	public function enqueue() {

		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_script( 'customizer-repeater-script', plugin_dir_url( __DIR__ ) . 'js/customizer_repeater.js', array('jquery', 'jquery-ui-draggable', 'wp-color-picker' ), '1.0.1', true  );

	}

	public function render_content() {

		/*Get default options*/
		$this_default = json_decode( $this->setting->default );

		/*Get values (json format)*/
		$values = $this->value();

		/*Decode values*/
		$json = json_decode( $values );

		if ( ! is_array( $json ) ) {
			$json = array( $values );
		} ?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="pirate_switch_general_control_repeater pirate_switch_general_control_droppable">
			<?php
			if ( ( count( $json ) == 1 && '' === $json[0] ) || empty( $json ) ) {
				if ( ! empty( $this_default ) ) {
					$this->iterate_array( $this_default ); ?>
					<input type="hidden"
					       id="pirate_switch_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?>
					       class="pirate_switch_repeater_colector"
					       value="<?php echo esc_textarea( json_encode( $this_default ) ); ?>"/>
					<?php
				} else {
					$this->iterate_array(); ?>
					<input type="hidden"
					       id="pirate_switch_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?>
					       class="pirate_switch_repeater_colector"/>
					<?php
				}
			} else {
				$this->iterate_array( $json ); ?>
				<input type="hidden" id="pirate_switch_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?>
				       class="pirate_switch_repeater_colector" value="<?php echo esc_textarea( $this->value() ); ?>"/>
				<?php
			} ?>
		</div>
		<button type="button" class="button add_field pirate_switch_general_control_new_field">
			<?php esc_html_e( 'Add new field', 'pirate-switch' ); ?>
		</button>
		<?php
	}

	private function iterate_array($array = array()){
		/*Counter that helps checking if the box is first and should have the delete button disabled*/
		$it = 0;
		if(!empty($array)){
			foreach($array as $icon){ ?>

				<div class="pirate_switch_general_control_repeater_container customizer-repeater-draggable">
					<div class="pirate-switch-customize-control-title">
						<?php esc_html_e( $this->boxtitle ) ?>
					</div>
					<div class="pirate-switch-box-content-hidden">
						<?php
						$image_url = $text = $link = $repeater = $color = '';
						if(!empty($icon->id)){
							$id = $icon->id;
						}

						if(!empty($icon->image_url)){
							$image_url = $icon->image_url;
						}

						if(!empty($icon->color)){
							$color = $icon->color;
						}

						if(!empty($icon->text)){
							$text = $icon->text;
						}
						if(!empty($icon->link)){
							$link = $icon->link;
						}

						if($this->customizer_repeater_image_control == true){
							$this->image_control($image_url);
						}

						if($this->customizer_repeater_color_control==true){
							$this->input_control(array(
								'label' => __('Color','pirate-switch'),
								'class' => 'pirate_switch_color_control',
								'type'  => 'color',
								'sanitize_callback' => 'sanitize_hex_color'
							), $color);
						}

						if($this->customizer_repeater_text_control==true){
							$this->input_control(array(
								'label' => __('Text','pirate-switch'),
								'class' => 'pirate_switch_text_control',
								'type'  => 'textarea'
							), $text);
						}

						if($this->customizer_repeater_link_control){
							$this->input_control(array(
								'label' => __('Link','pirate-switch'),
								'class' => 'pirate_switch_link_control',
								'sanitize_callback' => 'esc_url'
							), $link);
						}?>

						<input type="hidden" class="pirate_switch_box_id" value="<?php if ( ! empty( $id ) ) {
							echo esc_attr( $id );
						} ?>">
						<button type="button" class="pirate_switch_general_control_remove_field button" <?php if ( $it == 0 ) {
							echo 'style="display:none;"';
						} ?>>
							<?php esc_html_e( 'Delete field', 'pirate-switch' ); ?>
						</button>

					</div>
				</div>

				<?php
				$it++;
			}
		} else { ?>
			<div class="pirate_switch_general_control_repeater_container">
				<div class="pirate-switch-customize-control-title">
					<?php esc_html_e( $this->boxtitle ) ?>
				</div>
				<div class="pirate-switch-box-content-hidden">
					<?php
					if ( $this->customizer_repeater_image_control == true ) {
						$this->image_control();
					}

					if($this->customizer_repeater_color_control==true){
						$this->input_control(array(
							'label' => __('Color','pirate-switch'),
							'class' => 'pirate_switch_color_control',
							'type'  => 'color',
							'sanitize_callback' => 'sanitize_hex_color'
						) );
					}

					if ( $this->customizer_repeater_text_control == true ) {
						$this->input_control( array(
							'label' => __( 'Text', 'pirate-switch' ),
							'class' => 'pirate_switch_text_control',
							'type'  => 'textarea'
						) );
					}

					if ( $this->customizer_repeater_link_control == true ) {
						$this->input_control( array(
							'label' => __( 'Link', 'pirate-switch' ),
							'class' => 'pirate_switch_link_control'
						) );
					} ?>

					<input type="hidden" class="pirate_switch_box_id">
					<button type="button" class="pirate_switch_general_control_remove_field button" style="display:none;">
						<?php esc_html_e( 'Delete field', 'pirate-switch' ); ?>
					</button>
				</div>
			</div>
			<?php
		}
	}

	private function input_control( $options, $value='' ){ ?>
		<span class="customize-control-title"><?php echo $options['label']; ?></span>
		<?php
		if( !empty($options['type']) ){
			switch ($options['type']) {
				case 'textarea':?>
					<textarea class="<?php echo esc_attr($options['class']); ?>" placeholder="<?php echo $options['label']; ?>"><?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?></textarea>
					<?php
					break;
				case 'color': ?>
					<input type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" />
					<?php
					break;
			}
		} else { ?>
			<input type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" placeholder="<?php echo $options['label']; ?>"/>
			<?php
		}
	}

	private function image_control($value = ''){ ?>
		<div class="customizer-repeater-image-control">
            <span class="customize-control-title">
                <?php esc_html_e('Image','pirate-switch')?>
            </span>
			<input type="text" class="widefat custom_media_url" value="<?php echo esc_attr( $value ); ?>">
			<input type="button" class="button button-primary custom_media_button_pirate_switch" value="<?php esc_html_e('Upload Image','pirate-switch'); ?>" />
		</div>
		<?php
	}
}