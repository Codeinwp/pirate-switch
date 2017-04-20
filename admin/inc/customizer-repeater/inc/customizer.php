<?php
function pirate_switch_repeater_register( $wp_customize ) {
	require_once( plugin_dir_path( __DIR__ ) . 'class/pirate-switch-general-control.php' );
}
add_action( 'customize_register', 'pirate_switch_repeater_register' );

function pirate_switch_repeater_sanitize($input){
	$input_decoded = json_decode($input,true);
	if(!empty($input_decoded)) {
		foreach ($input_decoded as $boxk => $box ){
			foreach ($box as $key => $value){
				$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
			}
		}
		return json_encode($input_decoded);
	}
	return $input;
}

/**
 * Check if Repeater is empty
 *
 * @param string $parallax_one_arr Repeater json array.
 *
 * @return bool
 */
function pirate_switch_general_repeater_is_empty( $pirate_switch_arr ) {
    if ( empty( $pirate_switch_arr ) ) {
        return true;
    }
    $pirate_switch_arr_decoded = json_decode( $pirate_switch_arr, true );
    foreach ( $pirate_switch_arr_decoded as $item ) {
        foreach ( $item as $key => $value ) {
            if ( ! empty( $value ) ) {
                return false;
            }
        }
    }
    return true;
}