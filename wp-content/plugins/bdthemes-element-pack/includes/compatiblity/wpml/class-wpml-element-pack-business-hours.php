<?php

/**
 * Class WPML_ElementPack_Business_Hours
 */
class WPML_ElementPack_Business_Hours extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'business_days_times';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'enter_day', 'enter_time' );
	}

	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'enter_day':
				return esc_html__( 'Enter Day', 'bdthemes-element-pack' );

			case 'enter_time':
				return esc_html__( 'Enter Time', 'bdthemes-element-pack' );

			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch( $field ) {
			case 'enter_day':
				return 'LINE';
				
			case 'enter_time':
				return 'LINE';

			default:
				return '';
		}
	}

}
