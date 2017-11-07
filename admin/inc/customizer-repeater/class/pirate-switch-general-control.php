<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

class Pirate_Switch_General_Repeater extends WP_Customize_Control {

	public $id;
	private $boxtitle = array();
    private $add_field_label = array();
	private $customizer_repeater_image_control = false;
	private $customizer_repeater_color_control = false;
	private $customizer_repeater_text_control = false;
	private $customizer_repeater_link_control = false;



	/*Class constructor*/
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		/*Get options from customizer.php*/
        $this->add_field_label = esc_html__( 'Add new field', 'pirate-switch' );
        if ( ! empty( $args['add_field_label'] ) ) {
            $this->add_field_label = $args['add_field_label'];
        }

        $this->boxtitle = esc_html__( 'Pirate Switch', 'pirate-switch' );
        if ( ! empty ( $args['item_name'] ) ) {
            $this->boxtitle = $args['item_name'];
        } elseif ( ! empty( $this->label ) ) {
            $this->boxtitle = $this->label;
        }

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

        wp_enqueue_style( 'customizer-repeater-admin-stylesheet_ps', plugin_dir_url( __DIR__ ) . 'css/style.css','1.0.0' );

		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_script( 'customizer-repeater-script-ps', plugin_dir_url( __DIR__ ) . 'js/customizer_repeater_ps.js', array('jquery', 'jquery-ui-draggable', 'wp-color-picker' ), '1.0.1', true  );

	}

	public function render_content() {

        $repeater_content = $this->value();
        $values = array();
        if ( ! empty( $repeater_content ) ) {
            $values = $repeater_content;
        } else {
            if ( ! empty( $this->setting->default ) ) {
                $values = $this->setting->default;
            }
        } ?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="ps-general-control-repeater ps-general-control-droppable">
            <?php
            if ( ! pirate_switch_general_repeater_is_empty( $values ) ) {
                $valuse_decoded = json_decode( $values );
                $this->iterate_array( $valuse_decoded ); ?>
                <input type="hidden"
                       id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php $this->link(); ?>
                       class="ps-colector"
                       value="<?php echo esc_textarea( json_encode( $valuse_decoded ) ); ?>"/>
                <?php
            } else {
                $this->iterate_array(); ?>
                <input type="hidden"
                       id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php $this->link(); ?>
                       class="ps-colector"/>
                <?php
            } ?>
		</div>
		<button type="button" class="button add_field ps-new-field">
			<?php esc_html_e( 'Add new field', 'pirate-switch' ); ?>
		</button>
		<?php
	}

	private function iterate_array($array = array()){
		/*Counter that helps checking if the box is first and should have the delete button disabled*/
		$it = 0;
		if(!empty($array)){
			foreach($array as $icon){ ?>

				<div class="ps-general-control-repeater-container ps-draggable">
					<div class="ps-customize-control-title">
						<?php esc_html_e( $this->boxtitle ) ?>
					</div>
					<div class="ps-box-content-hidden">
						<?php
						$image_url = '';
						$text = '';
						$link = '';
						$color = '';

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

						if($this->customizer_repeater_image_control === true){
							$this->image_control( $image_url );
						}

						if($this->customizer_repeater_color_control === true){
							$this->input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__('Color','pirate-switch'), $this->id, 'customizer_repeater_color_control' ),
								'class' => 'pirate_switch_color_control',
								'type'  => apply_filters('repeater_input_types_filter', 'color', $this->id, 'customizer_repeater_color_control' ),
								'sanitize_callback' => 'sanitize_hex_color'
							), $color);
						}

						if($this->customizer_repeater_text_control==true){
							$this->input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__('Text','pirate-switch'), $this->id, 'customizer_repeater_text_control' ),
								'class' => 'pirate_switch_text_control',
								'type'  =>  apply_filters('repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_text_control' ),
							), $text);
						}

						if($this->customizer_repeater_link_control){
							$this->input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__('Link','pirate-switch'), $this->id, 'customizer_repeater_link_control' ),
								'class' => 'pirate_switch_link_control',
								'sanitize_callback' => 'esc_url_raw'
							), $link);
						}?>

						<button type="button" class="ps-general-control-remove-field" <?php if ( $it == 0 ) {
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
			<div class="ps-general-control-repeater-container">
				<div class="ps-customize-control-title">
					<?php esc_html_e( $this->boxtitle ) ?>
				</div>
				<div class="ps-box-content-hidden">
					<?php
					if ( $this->customizer_repeater_image_control == true ) {
						$this->image_control();
					}

					if($this->customizer_repeater_color_control==true){
						$this->input_control(array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__('Color','pirate-switch'), $this->id, 'customizer_repeater_color_control' ),
							'class' => 'pirate_switch_color_control',
                            'type'  => apply_filters('repeater_input_types_filter', 'color', $this->id, 'customizer_repeater_color_control' ),
							'sanitize_callback' => 'sanitize_hex_color'
						) );
					}

					if ( $this->customizer_repeater_text_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Text', 'pirate-switch' ), $this->id, 'customizer_repeater_text_control' ),
							'class' => 'pirate_switch_text_control',
							'type'  => apply_filters('repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_text_control' ),
						) );
					}

					if ( $this->customizer_repeater_link_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Link', 'pirate-switch' ), $this->id, 'customizer_repeater_link_control' ),
							'class' => 'pirate_switch_link_control',
                            'type'  => apply_filters('repeater_input_types_filter', '', $this->id, 'customizer_repeater_link_control' ),
						) );
					} ?>

					<button type="button" class="ps-general-control-remove-field" style="display:none;">
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
		<div class="ps-image-control">
            <span class="customize-control-title">
                <?php esc_html_e('Image','pirate-switch')?>
            </span>
			<input type="text" class="widefat ps-custom-media-url" value="<?php echo esc_attr( $value ); ?>">
			<input type="button" class="button button-secondary ps-custom-media-button" value="<?php esc_html_e('Upload Image','pirate-switch'); ?>" />
		</div>
		<?php
	}
}