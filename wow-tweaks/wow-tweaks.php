<?php
/*****
Plugin Name: WOW Tweaks
Plugin URI: http://sdminev.com
Description: 1. Add checkbox option for free plans @ admin
Version: 1.02
Author: Stefan Minev 🎉
Author URI: http://sdminev.com
*****/

//add_filter( 'product_type_options', 'add_plans_product_options' );
function add_plans_product_options( $product_type_options ) {
    $product_type_options['foodplan'] = array(
        'id'            => '_foodplan',
        'wrapper_class' => 'show_if_simple show_if_variable',
        'label'         => __( 'Foodplan', 'woocommerce' ),
        'description'   => __( '', 'woocommerce' ),
        'default'       => 'no'
    );

    $product_type_options['homegym'] = array(
        'id'            => '_homegym',
        'wrapper_class' => 'show_if_simple show_if_variable',
        'label'         => __( 'Homegym', 'woocommerce' ),
        'description'   => __( '', 'woocommerce' ),
        'default'       => 'no'
    );
    
    $product_type_options['yogaplan'] = array(
        'id'            => '_yogaplan',
        'wrapper_class' => 'show_if_simple show_if_variable',
        'label'         => __( 'Yogaplan', 'woocommerce' ),
        'description'   => __( '', 'woocommerce' ),
        'default'       => 'no'
    );
    return $product_type_options;
}

add_action( 'woocommerce_process_product_meta_simple', 'save_plans_option_fields'  );
add_action( 'woocommerce_process_product_meta_variable', 'save_plans_option_fields'  );
function save_plans_option_fields( $post_id ) {
    $is_foodplan = isset( $_POST['_foodplan'] ) ? 'yes' : 'no';
    update_post_meta( $post_id, '_foodplan', $is_foodplan );
        $is_homegym = isset( $_POST['_homegym'] ) ? 'yes' : 'no';
    update_post_meta( $post_id, '_homegym', $is_homegym );
        $is_yogaplan = isset( $_POST['_yogaplan'] ) ? 'yes' : 'no';
    update_post_meta( $post_id, '_yogaplan', $is_yogaplan );
}



function panam_tweaks_add_settings_page() {
	add_menu_page(
	  'WOW Tweaks',
	  'WOW Tweaks',
	  'manage_options',
	  'panam-tweaks-plugin',
	  'panam_tweaks_render_settings_page',
	  'dashicons-buddicons-community', // icon_url 
	   4 // position
	);
  }
add_action( 'admin_menu', 'panam_tweaks_add_settings_page' );
function panam_tweaks_render_settings_page() {
?>
    <h2>Tweaks Plugin Settings</h2>
    <form action="options.php" method="post">
    <?php
    settings_fields( 'panam_tweaks_plugin_settings' );
    do_settings_sections( 'panam_tweaks_plugin' );
    
    ?>
    <input
        type="submit"
        name="submit"
        class="button button-primary"
        value="<?php esc_attr_e( 'Save' ); ?>"
    />
    </form>
<?php
}
function panam_tweaks_register_settings() {
    register_setting(
        'panam_tweaks_plugin_settings',
        'panam_tweaks_plugin_settings',
        'panam_validate_tweaks_plugin_settings'
    );
    add_settings_section(
        'section_one',
        'Main Settings',
        'panam_tweaks_section_one_text',
        'panam_tweaks_plugin'
      );
    add_settings_field(
    'panam_explain_thankyou',
    'Youtube link to a explanantion video to render on "thank you" page',
    'panam_render_panam_explain_thankyou_field',
    'panam_tweaks_plugin',
    'section_one'
    );
    
    add_settings_field( 
    'payments_textarea_intro', 
    'Payments logos', 
    'payments_textarea_intro_render', 
    'panam_tweaks_plugin', 
    'section_one' 
    );
    
    add_settings_field( 
    'shippers_textarea_intro', 
    'Shippers logos', 
    'shippers_textarea_intro_render', 
    'panam_tweaks_plugin', 
    'section_one' 
    );
}

add_action( 'admin_init', 'panam_tweaks_register_settings' );

function panam_validate_tweaks_plugin_settings( $input ) {
		
    $output['panam_explain_thankyou'] = sanitize_text_field( $input['panam_explain_thankyou'] );
$output['shippers_textarea_intro'] =  $input['shippers_textarea_intro'];
$output['payments_textarea_intro'] =  $input['payments_textarea_intro'];
    
    return $output;
}
function panam_tweaks_section_one_text() {
    echo '<p>Whatever settings are here, boi</p>';
  }

function panam_render_panam_explain_thankyou_field() {
    $options = get_option( 'panam_tweaks_plugin_settings' );
    printf(
        '<input type="text" name="%s" value="%s" />',
        esc_attr( 'panam_tweaks_plugin_settings[panam_explain_thankyou]' ),
        esc_attr( $options['panam_explain_thankyou'] )
    );
}

function shippers_textarea_intro_render(  ) { 
    $options = get_option( 'panam_tweaks_plugin_settings', array() );

?><textarea cols='60' rows='22' name='panam_tweaks_plugin_settings[shippers_textarea_intro]'><?php echo isset( $options['shippers_textarea_intro'] ) ?  $options['shippers_textarea_intro'] : false; ?></textarea><?php
}

function payments_textarea_intro_render(  ) { 
    $options = get_option( 'panam_tweaks_plugin_settings', array() );

?><textarea cols='60' rows='22' name='panam_tweaks_plugin_settings[payments_textarea_intro]'><?php echo isset( $options['payments_textarea_intro'] ) ?  $options['payments_textarea_intro'] : false; ?></textarea><?php
}

function get_enabled_payments_and_shippers() {
    $active_gateways = array();
    $gateways        = WC()->payment_gateways->get_available_payment_gateways();
    print_r('<div class="fancy_button" style=" display: flex; flex-direction: column!important; flex-flow: row wrap; align-items: center; justify-content: center;">');
    echo '<h6 style="flex-basis:100%;margin:10px;">' . __('Payment methods', 'woocommerce') . '</h6>';
    //foreach ( $gateways as $gateway ) {

      //if ($gateway->enabled && $gateway->id != 'cod') {
        //$image = $gateway->icon;
        //if(substr( $image, 0, 4 ) === "<img") {echo $image;}else {echo '<img src="'. $image . '" class="mollie-gateway-icon" title="active gateway" style="order:1;"/>';}
        
      //}       elseif ($gateway->enabled && $gateway->id === 'cod') {

        //print_r('<p style="order: 2;margin: 0 0 0 13px; font-family: Gothic, Comfortaa, sans-serif; background: green; color: white; padding: 2px 6px; border-radius: 4px;"> & ' . $gateway->title .'</p>'. '<br />');
      //}
    //}
    $options = get_option( 'panam_tweaks_plugin_settings', array() );
    //$options['payments_textarea_intro'] .
echo  $options['payments_textarea_intro'] . $options['shippers_textarea_intro'] . '</div>';

    //print_r($active_gateways);
  }

add_shortcode('list_payment', 'get_enabled_payments_and_shippers');
add_filter('woocommerce_after_add_to_cart_button', 'get_enabled_payments_and_shippers');



//add_filter('wp_get_attachment_image_attributes', 'change_attachement_image_attributes', 20, 2);
function change_attachement_image_attributes( $attr, $attachment ) {
// Get post parent
$parent = get_post_field( 'post_parent', $attachment);

// Get post type to check if it's product
$type = get_post_field( 'post_type', $parent);
if( $type != 'product' ){

	if( $type == 'page' ){
	    $attr['alt'] = $title . ' ' . $sitename . ' ' . $attr['alt'];
    $attr['title'] = $title . ' ' . $sitename . ' ' . $attr['alt'];
	}
    else return $attr;
    
}

/// Get title
$title = get_post_field( 'post_title', $parent);
$sitename = get_bloginfo( $show = 'name');

    $attr['alt'] = $title . ' ' . $sitename . ' ' . $attr['alt'];
    $attr['title'] = $title . ' ' . $sitename . ' ' . $attr['alt'];


return $attr;
}
