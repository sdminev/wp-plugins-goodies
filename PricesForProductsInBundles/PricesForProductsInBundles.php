<?php
/*****
Plugin Name: Prices For Products In Bundles
Plugin URI: http://sdminev.com
Description: Add api meta Prices For Products In Bundles
Version: 1.0
Author: Stefan Minev
Author URI: http://sdminev.com
*****/

function log_me($message) {
    if ( WP_DEBUG === true ) {
        if ( is_array($message) || is_object($message) ) {
            error_log( print_r($message, true) );
        } else {
            error_log( $message );
        }
    }
}

function fester_add_settings_page() {
  add_menu_page(
    'Prices For Products In Bundles',
    'Bundles settings',
    'manage_options',
    'fester-example-plugin',
    'fester_render_settings_page',
    'dashicons-products', // icon_url
3 // position
  );
}
add_action( 'admin_menu', 'fester_add_settings_page' );

function fester_render_settings_page() {
?>
  <h2>Fester Plugin Settings</h2>
  <form action="options.php" method="post">
    <?php
    settings_fields( 'fester_example_plugin_settings' );
    do_settings_sections( 'fester_example_plugin' );
    //add_meta_to_old_orders();
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

function fester_register_settings() {
  register_setting(
    'fester_example_plugin_settings',
    'fester_example_plugin_settings',
    'fester_validate_example_plugin_settings'
  );

  add_settings_section(
    'section_one',
    'Main Settings',
    'fester_section_one_text',
    'fester_example_plugin'
  );

  /*add_settings_field(
    'some_text_field',
    'Some Text Field',
    'fester_render_some_text_field',
    'fester_example_plugin',
    'section_one'
  );*/

  add_settings_field(
    'regular_teas_field',
    'Regular Teas Base Price',
    'fester_render_regular_teas_field',
    'fester_example_plugin',
    'section_one'
  );

  add_settings_field(
    'promo_teas_field',
    'Promo Teas Base Price',
    'fester_render_promo_teas_field',
    'fester_example_plugin',
    'section_one'
  );

  add_settings_field(
    'bottles_field',
    'Bottles Base Price',
    'fester_render_bottles_field',
    'fester_example_plugin',
    'section_one'
  );

  add_settings_field(
    'superfood_field',
    'Superfood Base Price',
    'fester_render_superfood_field',
    'fester_example_plugin',
    'section_one'
  );

  add_settings_field(
    'superfood_x3_field',
    'Superfood X3 Base Price',
    'fester_render_superfood_x3_field',
    'fester_example_plugin',
    'section_one'
  );

  add_settings_field(
    'infuser_field',
    'Infuser Base Price',
    'fester_render_infuser_field',
    'fester_example_plugin',
    'section_one'
  );

  add_settings_field(
    'bands_field',
    'Booty Band Base Price',
    'fester_render_bands_field',
    'fester_example_plugin',
    'section_one'
  );

  /*add_settings_field(
    'another_number_field',
    'Another Number Field',
    'fester_render_another_number_field',
    'fester_example_plugin',
    'section_one'
  );*/


}



add_action( 'admin_init', 'fester_register_settings' );

function fester_validate_example_plugin_settings( $input ) {
    //$output['some_text_field']      = sanitize_text_field( $input['some_text_field'] );
    $output['regular_teas_field']      = sanitize_text_field( $input['regular_teas_field'] );
    $output['promo_teas_field']      = sanitize_text_field( $input['promo_teas_field'] );
    $output['bottles_field']      = sanitize_text_field( $input['bottles_field'] );
    $output['superfood_field']      = sanitize_text_field( $input['superfood_field'] );
    $output['superfood_x3_field']      = sanitize_text_field( $input['superfood_x3_field'] );
    $output['infuser_field']      = sanitize_text_field( $input['infuser_field'] );
    $output['bands_field']      = sanitize_text_field( $input['bands_field'] );
    //$output['another_number_field'] = absint( $input['another_number_field'] );
    // ...
    return $output;
}

function fester_section_one_text() {
  echo '<p>This is the first (and only) section in my settings.</p>';
}

function fester_render_some_text_field() {
  $options = get_option( 'fester_example_plugin_settings' );
  printf(
    '<input type="text" name="%s" value="%s" />',
    esc_attr( 'fester_example_plugin_settings[some_text_field]' ),
    esc_attr( $options['some_text_field'] )
  );
}

function fester_render_regular_teas_field() {
  $options = get_option( 'fester_example_plugin_settings' );
  printf(
    '<input type="text" name="%s" value="%s" />',
    esc_attr( 'fester_example_plugin_settings[regular_teas_field]' ),
    esc_attr( $options['regular_teas_field'] )
  );
}

function fester_render_promo_teas_field() {
  $options = get_option( 'fester_example_plugin_settings' );
  printf(
    '<input type="text" name="%s" value="%s" />',
    esc_attr( 'fester_example_plugin_settings[promo_teas_field]' ),
    esc_attr( $options['promo_teas_field'] )
  );
}

function fester_render_bottles_field() {
  $options = get_option( 'fester_example_plugin_settings' );
  printf(
    '<input type="text" name="%s" value="%s" />',
    esc_attr( 'fester_example_plugin_settings[bottles_field]' ),
    esc_attr( $options['bottles_field'] )
  );
}

function fester_render_superfood_field() {
  $options = get_option( 'fester_example_plugin_settings' );
  printf(
    '<input type="text" name="%s" value="%s" />',
    esc_attr( 'fester_example_plugin_settings[superfood_field]' ),
    esc_attr( $options['superfood_field'] )
  );
}

function fester_render_superfood_x3_field() {
  $options = get_option( 'fester_example_plugin_settings' );
  printf(
    '<input type="text" name="%s" value="%s" />',
    esc_attr( 'fester_example_plugin_settings[superfood_x3_field]' ),
    esc_attr( $options['superfood_x3_field'] )
  );
}

function fester_render_infuser_field() {
  $options = get_option( 'fester_example_plugin_settings' );
  printf(
    '<input type="text" name="%s" value="%s" />',
    esc_attr( 'fester_example_plugin_settings[infuser_field]' ),
    esc_attr( $options['infuser_field'] )
  );
}

function fester_render_bands_field() {
  $options = get_option( 'fester_example_plugin_settings' );
  printf(
    '<input type="text" name="%s" value="%s" />',
    esc_attr( 'fester_example_plugin_settings[bands_field]' ),
    esc_attr( $options['bands_field'] )
  );
}

function fester_render_another_number_field() {
  $options = get_option( 'fester_example_plugin_settings' );
  printf(
    '<input type="number" name="%s" value="%s" />',
    esc_attr( 'fester_example_plugin_settings[another_number_field]' ),
    esc_attr( $options['another_number_field'] )
  );
}
/*
 * Retrieve this value with:
 * $prices_for_products_in_bundles_options = get_option( 'prices_for_products_in_bundles_option_name' ); // Array of All Options
 * $regular_teas_0 = $prices_for_products_in_bundles_options['regular_teas_0']; // Regular teas
 * $promo_teas_1 = $prices_for_products_in_bundles_options['promo_teas_1']; // Promo teas
 * $bottles_2 = $prices_for_products_in_bundles_options['bottles_2']; // Bottles
 * $bands_3 = $prices_for_products_in_bundles_options['bands_3']; // Bands
 * $infuser_4 = $prices_for_products_in_bundles_options['infuser_4']; // Infuser
 * $superfood_5 = $prices_for_products_in_bundles_options['superfood_5']; // Superfood
 * $superfoodx3_6 = $prices_for_products_in_bundles_options['superfoodx3_6']; // SuperfoodX3
 */

add_action('woocommerce_checkout_create_order', 'before_checkout_create_order', 20, 2);

function before_checkout_create_order($order)
{
    $coupondiscount = 0;
    if (!empty($order->get_coupon_codes())) {
        foreach ($order->get_coupon_codes() as $code) {
            $coupon = new WC_Coupon($code);
            if ($coupon->type == 'percent_product' || $coupon->type == 'percent')
                $coupondiscount += $coupon->amount;
        }
    }

    $options = get_option('fester_example_plugin_settings');
    $regular = $options['regular_teas_field'];

    foreach ($order->get_items() as $item_key => $orderItem) {

        $product = $order->get_product_from_item($orderItem);
        $sku = $product->get_sku();

        $finalprice = $product->get_price() - ($product->get_price() * ($coupondiscount / 100));

        $formulas = [
            'TeaTea' => [
                'WOW-P-DTXSF',
                'WOW-P-SFDTX',
                'WOW-P-SFSET',
                'WOW-P-SFWNS',
                'WOW-P-DTXWNS',
                'WOW-P-SETWNS',
                'WOW-S-BL1BL2',
                'WOW-P-SETSST',
                'WOW-P-SETSWT',
                'WOW-P-SSTSWT',
                'WOW-P-MDTXMSF',

            ],
            'TeaItem' => [
                'WOW-P-DTXBTP',
                'WOW-P-DTXBTB',
                'WOW-P-SFBTP',
                'WOW-P-SFBTB',
                'WOW-P-WNSBTP',
                'WOW-P-WNSBTB',
                'WOW-P-SETBTP',
                'WOW-P-SETBTB',
                'WOW-P-SFSLFT',
                'WOW-P-WNSSLFT',
                'WOW-P-DTXSLFT',
                'WOW-P-SETSLFT',
                'WOW-P-SETBTY',
                'WOW-P-SSTBTY',
                'WOW-P-SWTBTY',
                'WOW-P-DTXSFR',
                'WOW-P-SFSFR',
                'WOW-P-WNSSFR',
                'WOW-P-DTXTTP',
                'WOW-P-DTXTTO',
                'WOW-P-DTXTTB',
                'WOW-P-SFTTP',
                'WOW-P-SFTTO',
                'WOW-P-SFTTB',
                'WOW-P-WNSTTP',
                'WOW-P-WNSTTB',
                'WOW-P-WNSTTO',
                'WOW-P-MDTXBTG',
                'WOW-P-MSFBTG',


            ],
            'TeaTeaBottle' => [
                'WOW-P-2DTXBTP',
                'WOW-P-2DTXBTB',
                'WOW-P-2SFBTP',
                'WOW-P-2SFBTB',
                'WOW-P-2SETBTP',
                'WOW-P-2SETBTB',
                'WOW-P-SFDTXBTP',
                'WOW-P-SFDTXBTB',
                'WOW-P-SFSETBTP',
                'WOW-P-SFSETBTB',
                'WOW-P-SFWNSBTP',
                'WOW-P-SFWNSBTB',
                'WOW-P-DTXWNSBTP',
                'WOW-P-DTXWNSBTB',
                'WOW-P-SETWNSBTP',
                'WOW-P-SETWNSBTB',
                'WOW-P-SETSWTBTY',
                'WOW-P-SETSSTBTY',
                'WOW-P-SSTSWTBTY',
                'WOW-P-2DTXTTP',
                'WOW-P-2DTXTTO',
                'WOW-P-2DTXTTB',
                'WOW-P-2SFTTP',
                'WOW-P-2SFTTO',
                'WOW-P-2SFTTB',
                'WOW-P-SFDTXTTP',
                'WOW-P-SFDTXTTO',
                'WOW-P-SFDTXTTB',
                'WOW-P-SFWNSTTP',
                'WOW-P-SFWNSTTO',
                'WOW-P-SFWNSTTB',
                'WOW-P-MDTXMSFBTG',

            ],
            'TeaTeaBottleBottle' => [
                'WOW-P-WOWPP',
                'WOW-P-DTXSFBTBTTP',
                
            ],
            'TeaTeaTeaBottleBottle' => [
                'WOW-P-SFDTXWNSBTBBTP',
            ],
            'TeaFoodBottle' => [
                'WOW-P-SFSLFTBTB',
                'WOW-P-DTXSFRBTP',
            ],
            'TeaFoodBottleBandBand' => [
                'WOW-P-SFSLFTBTBBL1BL2',
            ],
            'TeaFoodBandBand' => [
                'WOW-P-SFSLFTBL1BL2'
            ],
            'FoodFoodFood' => [
                'WOW-F-SLFT3',
                'WOW-F-SFR3',
            ],
        ];

        $packets = [
            'WOW-P-DTXSF' => [
                'WOW-T-DTX',
                'WOW-T-SF',
            ],
            'WOW-P-SFDTX' => [
                'WOW-T-SF',
                'WOW-T-DTX',
            ],
            'WOW-P-SFSET' => [
                'WOW-T-SF',
                'WOW-T-SET',
            ],
            'WOW-P-SFWNS' => [
                'WOW-T-SF',
                'WOW-T-WNS',
            ],
            'WOW-P-DTXWNS' => [
                'WOW-T-DTX',
                'WOW-T-WNS',
            ],
            'WOW-P-SETWNS' => [
                'WOW-T-SET',
                'WOW-T-WNS',
            ],
            'WOW-S-BL1BL2' => [
                'WOW-S-BL1',
                'WOW-S-BL2',
            ],
            'WOW-P-DTXBTP' => [
                'WOW-T-DTX',
                'WOW-B-T-P',
            ],
            'WOW-P-DTXBTB' => [
                'WOW-T-DTX',
                'WOW-B-T-B',
            ],
            'WOW-P-SFBTP' => [
                'WOW-T-SF',
                'WOW-B-T-P',
            ],
            'WOW-P-SFBTB' => [
                'WOW-T-SF',
                'WOW-B-T-B',
            ],
            'WOW-P-WNSBTP' => [
                'WOW-T-WNS',
                'WOW-B-T-P',
            ],
            'WOW-P-WNSBTB' => [
                'WOW-T-WNS',
                'WOW-B-T-B',
            ],
            'WOW-P-SETBTP' => [
                'WOW-T-SET',
                'WOW-B-T-P',
            ],
            'WOW-P-SETBTB' => [
                'WOW-T-SET',
                'WOW-B-T-B',
            ],
            'WOW-P-SFSLFT' => [
                'WOW-T-SF',
                'WOW-F-SLFT',
            ],
            'WOW-P-WNSSLFT' => [
                'WOW-T-WNS',
                'WOW-F-SLFT',
            ],
            'WOW-P-DTXSLFT' => [
                'WOW-T-DTX',
                'WOW-F-SLFT',
            ],
            'WOW-P-SETSLFT' => [
                'WOW-T-SET',
                'WOW-F-SLFT',
            ],
            'WOW-P-2DTXBTP' => [
                'WOW-T-DTX',
                'WOW-T-DTX',
                'WOW-B-T-P',
            ],
            'WOW-P-2DTXBTB' => [
                'WOW-T-DTX',
                'WOW-T-DTX',
                'WOW-B-T-B',
            ],
            'WOW-P-2SFBTP' => [
                'WOW-T-SF',
                'WOW-T-SF',
                'WOW-B-T-P',
            ],
            'WOW-P-2SFBTB' => [
                'WOW-T-SF',
                'WOW-T-SF',
                'WOW-B-T-B',
            ],
            'WOW-P-2SETBTP' => [
                'WOW-T-SET',
                'WOW-T-SET',
                'WOW-B-T-P',
            ],
            'WOW-P-2SETBTB' => [
                'WOW-T-SET',
                'WOW-T-SET',
                'WOW-B-T-B',
            ],
            'WOW-P-SFDTXBTP' => [
                'WOW-T-SF',
                'WOW-T-DTX',
                'WOW-B-T-P',
            ],
            'WOW-P-SFDTXBTB' => [
                'WOW-T-SF',
                'WOW-T-DTX',
                'WOW-B-T-B',
            ],
            'WOW-P-SFSETBTP' => [
                'WOW-T-SF',
                'WOW-T-SET',
                'WOW-B-T-P',
            ],
            'WOW-P-SFSETBTB' => [
                'WOW-T-SF',
                'WOW-T-SET',
                'WOW-B-T-B',
            ],
            'WOW-P-SFWNSBTP' => [
                'WOW-T-SF',
                'WOW-T-WNS',
                'WOW-B-T-P',
            ],
            'WOW-P-SFWNSBTB' => [
                'WOW-T-SF',
                'WOW-T-WNS',
                'WOW-B-T-B',
            ],
            'WOW-P-DTXWNSBTP' => [
                'WOW-T-DTX',
                'WOW-T-WNS',
                'WOW-B-T-P',
            ],
            'WOW-P-DTXWNSBTB' => [
                'WOW-T-DTX',
                'WOW-T-WNS',
                'WOW-B-T-B',
            ],
            'WOW-P-SETWNSBTP' => [
                'WOW-T-SET',
                'WOW-T-WNS',
                'WOW-B-T-P',
            ],
            'WOW-P-SETWNSBTB' => [
                'WOW-T-SET',
                'WOW-T-WNS',
                'WOW-B-T-B',
            ],
            'WOW-P-WOWPP' => [
                'WOW-T-DTX',
                'WOW-T-SF',
                'WOW-B-T-B',
                'WOW-B-T-P',
            ],
            'WOW-P-SFDTXWNSBTBBTP' => [
                'WOW-T-DTX',
                'WOW-T-SF',
                'WOW-T-WNS',
                'WOW-B-T-B',
                'WOW-B-T-P',
            ],
            'WOW-P-SFSLFTBTB' => [
                'WOW-T-SF',
                'WOW-F-SLFT',
                'WOW-B-T-B',
            ],
            'WOW-P-SFSLFTBTBBL1BL2' => [
                'WOW-T-SF',
                'WOW-F-SLFT',
                'WOW-B-T-B',
                'WOW-S-BL1',
                'WOW-S-BL2',
            ],
            'WOW-P-SFSLFTBL1BL2' => [
                'WOW-T-SF',
                'WOW-F-SLFT',
                'WOW-S-BL1',
                'WOW-S-BL2',
            ],
            'WOW-F-SLFT3' => [
                'WOW-F-SLFT',
                'WOW-F-SLFT',
                'WOW-F-SLFT_1',
            ],
            'WOW-P-SETBTY' => [
                'WOW-T-SET',
                'WOW-B-T-Y',
            ],
            'WOW-P-SSTBTY' => [
                'WOW-T-SST',
                'WOW-T-SWT',
            ],
            'WOW-P-SWTBTY' => [
                'WOW-T-SWT',
                'WOW-B-T-Y',
            ],
            'WOW-P-SETSWTBTY' => [
                'WOW-T-SET',
                'WOW-T-SWT',
                'WOW-B-T-Y',
            ],
            'WOW-P-SETSSTBTY' => [
                'WOW-T-SET',
                'WOW-T-SST',
                'WOW-B-T-Y',
            ],
            'WOW-P-SSTSWTBTY' => [
                'WOW-T-SST',
                'WOW-T-SWT',
                'WOW-B-T-Y',
            ],
            'WOW-P-SETSST' => [
                'WOW-T-SET',
                'WOW-T-SST',
            ],
            'WOW-P-SETSWT' => [
                'WOW-T-SET',
                'WOW-T-SWT',
            ],
            'WOW-P-SSTSWT' => [
                'WOW-T-SST',
                'WOW-T-SWT',
            ],
                'WOW-P-DTXSFR' => [
                'WOW-T-DTX',
                'WOW-F-SFR',
            ],
                'WOW-P-SFSFR' => [
                'WOW-T-SF',
                'WOW-F-SFR',
            ],
                'WOW-P-WNSSFR' => [
                'WOW-T-WNS',
                'WOW-F-SFR',
            ],
                'WOW-F-SFR3' => [
                'WOW-F-SFR',
                'WOW-F-SFR',
                'WOW-F-SFR_1',
            ],
                'WOW-P-DTXSFRBTP' => [
                'WOW-T-DTX',
                'WOW-F-SFR',
                'WOW-B-T-P',
            ],
            'WOW-P-DTXTTP' => [
                'WOW-T-DTX',
                'WOW-T-TTP',
            ],
            'WOW-P-DTXTTO' => [
                'WOW-T-DTX',
                'WOW-T-TTO',
            ],
            'WOW-P-DTXTTB' => [
                'WOW-T-DTX',
                'WOW-T-TTB',
            ],
            'WOW-P-SFTTP' => [
                'WOW-T-SF',
                'WOW-T-TTP',
            ],
            'WOW-P-SFTTO' => [
                'WOW-T-SF',
                'WOW-T-TTO',
            ],
            'WOW-P-SFTTB' => [
                'WOW-T-SF',
                'WOW-T-TTB',
            ],
            'WOW-P-WNSTTP' => [
                'WOW-T-WNS',
                'WOW-T-TTP',
            ],
            'WOW-P-WNSTTO' => [
                'WOW-T-WNS',
                'WOW-T-TTO',
            ],
            'WOW-P-WNSTTB' => [
                'WOW-T-WNS',
                'WOW-T-TTB',
            ],
            'WOW-P-2DTXTTP' => [
                'WOW-T-DTX',
                'WOW-T-DTX',
                'WOW-T-TTP',
            ],
            'WOW-P-2DTXTTO' => [
                'WOW-T-DTX',
                'WOW-T-DTX',
                'WOW-T-TTO',
            ],
            'WOW-P-2DTXTTB' => [
                'WOW-T-DTX',
                'WOW-T-DTX',
                'WOW-T-TTB',
            ],
            'WOW-P-2SFTTP' => [
                'WOW-T-SF',
                'WOW-T-SF',
                'WOW-T-TTP',
            ],
            'WOW-P-2SFTTO' => [
                'WOW-T-SF',
                'WOW-T-SF',
                'WOW-T-TTO',
            ],
            'WOW-P-2SFTTB' => [
                'WOW-T-SF',
                'WOW-T-SF',
                'WOW-T-TTB',
            ],
            'WOW-P-SFDTXTTP' => [
                'WOW-T-SF',
                'WOW-T-DTX',
                'WOW-T-TTP',
            ],
            'WOW-P-SFDTXTTO' => [
                'WOW-T-SF',
                'WOW-T-DTX',
                'WOW-T-TTO',
            ],
            'WOW-P-SFDTXTTB' => [
                'WOW-T-SF',
                'WOW-T-DTX',
                'WOW-T-TTB',
            ],
            'WOW-P-SFWNSTTP' => [
                'WOW-T-SF',
                'WOW-T-WNS',
                'WOW-T-TTP',
            ],
            'WOW-P-SFWNSTTO' => [
                'WOW-T-SF',
                'WOW-T-WNS',
                'WOW-T-TTO',
            ],
            'WOW-P-SFWNSTTB' => [
                'WOW-T-SF',
                'WOW-T-WNS',
                'WOW-T-TTB',
            ],
            'WOW-P-DTXSFBTBTTP' => [
                'WOW-T-DTX',
                'WOW-T-SF',
                'WOW-B-T-B',
                'WOW-T-TTP',
            ],
            'WOW-P-MDTXBTG' => [
                'WOW-T-MDTX',
                'WOW-B-T-G',
            ],
            'WOW-P-MSFBTG' => [
                'WOW-T-MSF',
                'WOW-B-T-G',
            ],
            'WOW-P-MDTXMSF' => [
                'WOW-T-MDTX',
                'WOW-T-MSF',
            ],
            'WOW-P-MDTXMSFBTG' => [
                'WOW-T-MDTX',
                'WOW-T-MSF',
                'WOW-B-T-G',
            ],

        ];

        if (array_key_exists($sku, $packets)) {
            $prices = [];
            if (in_array($sku, $formulas['TeaTea'])) {
                $teaPrice1 = round($finalprice / 2, 2);
                $teaPrice2 = $finalprice - $teaPrice1;
                $prices = [
                    $teaPrice1,
                    $teaPrice2
                ];
            } elseif (in_array($sku, $formulas['TeaItem'])) {
                $item = $finalprice - $regular;
                $prices = [
                    $regular,
                    $item
                ];
            } elseif (in_array($sku, $formulas['TeaTeaBottle'])) {
                $teaPrice1 = $teaPrice2 = $regular;
                if (($finalprice - ($teaPrice1 + $teaPrice2)) < ($finalprice * 0.10)) {
                    $midFinalPrice = round($finalprice - ($finalprice * 0.10));
                    $teaPrice1 = $teaPrice2 = round( $midFinalPrice / 2, 2);
                }
                $bottle = $finalprice - ($teaPrice1 + $teaPrice2);
                $prices = [
                    $teaPrice1,
                    $teaPrice2,
                    $bottle
                ];
            } elseif (in_array($sku, $formulas['TeaTeaBottleBottle'])) {
                $teaPrice1 = $teaPrice2 = $regular;
                $bottles = $finalprice - ($teaPrice1 + $teaPrice2);
                if ($bottles < ($finalprice * 0.20)) {
                    $bottle1 = $bottle2 = round($finalprice * 0.10, 2);
                    $teaPrice1 = round(($finalprice - ($bottle1 + $bottle2)) / 2, 2);
                    $teaPrice2 = $finalprice - ($teaPrice1 + $bottle1 + $bottle2);
                } else {
                    $bottle1 = round($bottles / 2, 2);
                    $bottle2 = $bottles - $bottle1;
                }
                $prices = [
                    $teaPrice1,
                    $teaPrice2,
                    $bottle1,
                    $bottle2
                ];
            } elseif (in_array($sku, $formulas['TeaTeaTeaBottleBottle'])) {
                $teaPrice1 = $teaPrice2 = $teaPrice3 = $regular;
                $bottles = $finalprice - ($teaPrice1 + $teaPrice2 + $teaPrice3);
                if ($bottles < ($finalprice * 0.20)) {
                    $bottle1 = $bottle2 = round($finalprice * 0.10, 2);
                    $teaPrice1 = $teaPrice2 = round(($finalprice - ($bottle1 + $bottle2)) / 3, 2);
                    $teaPrice3 = $finalprice - ($teaPrice1 + $teaPrice2 + $bottle1 + $bottle2);
                } else {
                    $bottle1 = round($bottles / 2, 2);
                    $bottle2 = $bottles - $bottle1;
                }
                $prices = [
                    $teaPrice1,
                    $teaPrice2,
                    $teaPrice3,
                    $bottle1,
                    $bottle2
                ];
            } elseif (in_array($sku, $formulas['TeaFoodBottle'])) {
                $food = round(($finalprice - $regular) / 2, 2);
                $bottle = $finalprice - ($regular + $food);
                $prices = [
                    $regular,
                    $food,
                    $bottle
                ];
            } elseif (in_array($sku, $formulas['TeaFoodBottleBandBand'])) {
                $food = $bottle = $band1 = round(($finalprice - $regular) / 4, 2);
                $band2 = $finalprice - ($regular + $food + $bottle + $band1);
                $prices = [
                    $regular,
                    $food,
                    $bottle,
                    $band1,
                    $band2
                ];
            } elseif (in_array($sku, $formulas['TeaFoodBandBand'])) {
                $food = $band1 = round(($finalprice - $regular) / 3, 2);
                $band2 = $finalprice - ($regular + $food + $band1);
                $prices = [
                    $regular,
                    $food,
                    $band1,
                    $band2
                ];
            } elseif (in_array($sku, $formulas['FoodFoodFood'])) {
                $food1 = $food2 = round($finalprice / 3, 2);
                $food3 = $finalprice - ($food1 + $food2);
                $prices = [
                    $food1,
                    $food2,
                    $food3
                ];
            }

            $priceByItem = array_combine($packets[$sku], $prices);
            $orderItem->add_meta_data('fstr_base_price', $priceByItem, true);
        }
    }
}
