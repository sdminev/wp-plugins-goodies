<?php
/*****
Plugin Name: Custom fields for variations
Plugin URI: http://sdminev.com
Description: Add custom fields to variations
Version: 1.0
Author: Stefan Minev
Author URI: http://sdminev.com
*****/
/*
 * Add Custom Fields to variable products
 */
function fstr_woo_add_custom_variation_fields( $loop, $variation_data, $variation ) {

	echo '<div class="options_group form-row form-row-full">';

 	// Text Field
	woocommerce_wp_text_input(
		array(
			'id'          => '_variable_text_field_1[' . $variation->ID . ']',
			'label'       => __( 'Google Title', 'woocommerce' ),
			'placeholder' => 'Insert Google Title Here',
			'desc_tip'    => true,
			'description' => __( "Here's some google title text'", "woocommerce" ),
			'value' => get_post_meta( $variation->ID, '_variable_text_field_1', true )
		)
 	);

	// Add extra custom fields here as necessary...

	echo '</div>';
	
	echo '<div class="options_group form-row form-row-full">';

 	// Text Field
	woocommerce_wp_text_input(
		array(
			'id'          => '_variable_text_field_2[' . $variation->ID . ']',
			'label'       => __( 'Google Description', 'woocommerce' ),
			'placeholder' => 'Insert Google Description Here',
			'desc_tip'    => true,
			'description' => __( "Here's some google description text'", "woocommerce" ),
			'value' => get_post_meta( $variation->ID, '_variable_text_field_2', true )
		)
 	);
 	
 	
 	 	// Text Field
	woocommerce_wp_text_input(
		array(
			'id'          => '_variable_text_field_3[' . $variation->ID . ']',
			'label'       => __( 'Bundle SKUs and prices', 'woocommerce' ),
			'placeholder' => 'Bundle SKUs and prices',
			'desc_tip'    => true,
			'description' => __( "Here's some google description text'", "woocommerce" ),
			'value' => get_post_meta( $variation->ID, '_variable_text_field_3', true )
		)
 	);

	// Add extra custom fields here as necessary...

	echo '</div>';	

}
// Variations tab
//add_action( 'woocommerce_variation_options', 'fstr_woo_add_custom_variation_fields', 10, 3 ); // After variation Enabled/Downloadable/Virtual/Manage Stock checkboxes
//add_action( 'woocommerce_variation_options_pricing', 'fstr_woo_add_custom_variation_fields', 10, 3 ); // After Price fields
//add_action( 'woocommerce_variation_options_inventory', 'fstr_woo_add_custom_variation_fields', 10, 3 ); // After Manage Stock fields
//add_action( 'woocommerce_variation_options_dimensions', 'fstr_woo_add_custom_variation_fields', 10, 3 ); // After Weight/Dimension fields
//add_action( 'woocommerce_variation_options_tax', 'fstr_woo_add_custom_variation_fields', 10, 3 ); // After Shipping/Tax Class fields
//add_action( 'woocommerce_variation_options_download', 'fstr_woo_add_custom_variation_fields', 10, 3 ); // After Download fields
add_action( 'woocommerce_product_after_variable_attributes', 'fstr_woo_add_custom_variation_fields', 10, 3 ); // After all Variation fields

/*
 * Save our variable product fields
 */
function fstr_woo_add_custom_variation_fields_save( $post_id ){

 	// Text Field 1
 	$woocommerce_text_field_1 = $_POST['_variable_text_field_1'][ $post_id ];
	update_post_meta( $post_id, '_variable_text_field_1', esc_attr( $woocommerce_text_field_1 ) );
	
	// Text Field 2
 	$woocommerce_text_field_2 = $_POST['_variable_text_field_2'][ $post_id ];
	update_post_meta( $post_id, '_variable_text_field_2', esc_attr( $woocommerce_text_field_2 ) );
	
	 	$woocommerce_text_field_3 = $_POST['_variable_text_field_3'][ $post_id ];
	update_post_meta( $post_id, '_variable_text_field_3', esc_attr( $woocommerce_text_field_3 ) );
	
		 	$fstr_p_sub = get_post_meta( $post_id, 'fstr-p-sub', true );
	update_post_meta( $post_id, 'fstr-p-sub', esc_attr( $fstr_p_sub) );


}
add_action( 'woocommerce_save_product_variation', 'fstr_woo_add_custom_variation_fields_save', 10, 2 );

/*
 * Display our custom field above the summary on the Single Product Page
 */
/*function fstr_display_woo_custom_fields() {
	global $post;

	$fstrTextField1 = get_post_meta( $post->ID, '_variable_text_field_1', true );
	$fstrTextField2 = get_post_meta( $post->ID, '_variable_text_field_2', true );

	if ( !empty( $fstrTextField1 ) ) {
		echo '<div>Google Title: ' . $fstrTextField1 . '</div>';
	}
	if ( !empty( $fstrTextField2 ) ) {
		echo '<div>Google Description: ' . $fstrTextField2 . '</div>';
	}
}
add_action( 'woocommerce_single_product_summary', 'mytheme_display_woo_custom_fields', 15 );*/
