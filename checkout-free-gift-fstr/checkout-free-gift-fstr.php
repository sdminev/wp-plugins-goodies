<?php
/*****
Plugin Name: Checkout Free Gift Fester
Plugin URI: http://sdminev.com
Description: Add free gift in checkout page
Version: 1.0
Author: Stefan Minev
Author URI: http://sdminev.com
*****/

function cfgf_init()
{
    load_plugin_textdomain('checkout-free-gift-fstr', false, dirname(plugin_basename(__FILE__)));
}
add_action('init', 'cfgf_init');

// General page UI
add_filter('admin_init', 'fstr_inputs');

function fstr_inputs()
{
    register_setting('general', 'fstr_homegym', 'esc_attr');
    add_settings_field('fstr_homegym', '<label for="fstr_homegym">' . __('HomeGym ID', 'fstr_homegym') . '</label>', 'fstr_homegym_html', 'general');

    register_setting('general', 'fstr_food', 'esc_attr');
    add_settings_field('fstr_food', '<label for="fstr_food">' . __('Food Plan ID', 'fstr_food') . '</label>', 'fstr_food_html', 'general');

    register_setting('general', 'fstr_yoga', 'esc_attr');
    add_settings_field('fstr_yoga', '<label for="fstr_yoga">' . __('Yoga Plan ID', 'fstr_yoga') . '</label>', 'fstr_yoga_html', 'general');

    register_setting('general', 'panam_booty', 'esc_attr');
    add_settings_field('panam_booty', '<label for="panam_booty">' . __('Booty plan ID', 'panam_booty') . '</label>', 'panam_booty_html', 'general');

    register_setting('general', 'panam_recipes', 'esc_attr');
    add_settings_field('panam_recipes', '<label for="panam_recipes">' . __('25 recipes ID', 'panam_recipes') . '</label>', 'panam_recipes_html', 'general'); register_setting('general', 'panam_recipes_fruit', 'esc_attr'); add_settings_field('panam_recipes_fruit', '<label for="panam_recipes_fruit">' . __('25 recipes FRUIT ID', 'panam_recipes_fruit') . '</label>', 'panam_recipes_fruit_html', 'general');


    /**adding settings option free foodplan/yoga/shoppinglist/homegym settings**/


    register_setting('general', 'yoga_plan', 'esc_attr');
    add_settings_field('yoga_plan', '<label for="yoga_plan">' . __('Yoga Plan Link', 'yoga_plan') . '</label>', 'yoga_plan_html', 'general');

    register_setting('general', 'homegym', 'esc_attr');
    add_settings_field('homegym', '<label for="homegym">' . __('Homegym Link', 'homegym') . '</label>', 'homegym_html', 'general');

    register_setting('general', 'panam_food_plan', 'esc_attr');
    add_settings_field('panam_food_plan', '<label for="panam_food_plan">' . __('Food Plan Link', 'panam_food_plan') . '</label>', 'panam_food_plan_html', 'general');

    register_setting('general', 'shopping_list', 'esc_attr');
    add_settings_field('shopping_list', '<label for="shopping_list">' . __('Shopping List Link', 'shopping_list') . '</label>', 'shopping_list_html', 'general');

    register_setting('general', 'bootyplan', 'esc_attr');
    add_settings_field('bootyplan', '<label for="bootyplan">' . __('Booty plan Link', 'bootyplan') . '</label>', 'bootyplan_html', 'general');

    register_setting('general', 'recipes', 'esc_attr');
    add_settings_field('recipes', '<label for="recipes">' . __('25 recipes Link', 'recipes') . '</label>', 'recipes_html', 'general'); register_setting('general', 'recipesfruit', 'esc_attr');add_settings_field('recipesfruit', '<label for="recipesfruit">' . __('25 recipes Fruit Link', 'recipesfruit') . '</label>', 'recipes_fruit_html', 'general');

}

/**Adding links to free plans in general settings**/
function yoga_plan_html()
{
    $value = get_option('yoga_plan', '');
    echo '';
    echo '<input type="text" id="yoga_plan" name="yoga_plan" placeholder="Yoga Plan Link (ex. 1,5,25)" value="' . $value . '" />';
    echo '<p class="description" id="timezone-description">Choose the link of the Yoga plan product</p>';
}
function homegym_html()
{
    $value = get_option('homegym', '');
    echo '';
    echo '<input type="text" id="homegym" name="homegym" placeholder="HomeGym Link (ex. 1,5,25)" value="' . $value . '" />';
    echo '<p class="description" id="timezone-description">Choose the link of the Home Gym product</p>';
}
function panam_food_plan_html()
{
    $value = get_option('panam_food_plan', '');
    echo '';
    echo '<input type="text" id="panam_food_plan" name="panam_food_plan" placeholder="Food Plan Link" value="' . $value . '" />';
    echo '<p class="description" id="timezone-description">Choose the link of the Food Plan product</p>';
}
function shopping_list_html()
{
    $value = get_option('shopping_list', '');
    echo '';
    echo '<input type="text" id="shopping_list" name="shopping_list" placeholder="Shopping list link (ex. 1,5,25)" value="' . $value . '" />';
    echo '<p class="description" id="timezone-description">Choose the link of the shoppink list product</p>';
}
function bootyplan_html()
{
    $value = get_option('bootyplan', '');
    echo '';
    echo '<input type="text" id="bootyplan" name="bootyplan" placeholder="Booty fit plan link (ex. 1,5,25)" value="' . $value . '" />';
    echo '<p class="description" id="timezone-description">Choose the link of the bootyplan</p>';
}
function recipes_html()
{
    $value = get_option('recipes', '');
    echo '';
    echo '<input type="text" id="recipes" name="recipes" placeholder="25 recipes link (ex. 1,5,25)" value="' . $value . '" />';
    echo '<p class="description" id="timezone-description">Choose the link of the recipes</p>';
}
/**end of section**/ function recipes_fruit_html(){    $value = get_option('recipesfruit', '');    echo '';    echo '<input type="text" id="recipesfruit" name="recipesfruit" placeholder="25 recipes FRUIT link (ex. 1,5,25)" value="' . $value . '" />';echo '<p class="description" id="timezone-description">Choose the link of the FRUIT recipes</p>';}

function fstr_homegym_html()
{
    $value = get_option('fstr_homegym', '');
    echo '';
    echo '<input type="text" id="fstr_homegym" name="fstr_homegym" placeholder="HomeGym ID (ex. 1,5,25)" value="' . $value . '" />';
    echo '<p class="description" id="timezone-description">Choose the ID of the Home Gym product</p>';
}

function fstr_food_html()
{
    $value = get_option('fstr_food', '');
    echo '<input type="text" id="fstr_food" name="fstr_food" placeholder="Food Plan ID (ex. 1,5,25)" value="' . $value . '" />';
    echo '<p class="description" id="timezone-description">Choose the ID of the Food Plan product</p>';
}

function fstr_yoga_html()
{
    $value = get_option('fstr_yoga', '');
    echo '<input type="text" id="fstr_yoga" name="fstr_yoga" placeholder="Yoga Plan ID (ex. 1,5,25)" value="' . $value . '" />';
    echo '<p class="description" id="timezone-description">Choose the ID of the Yoga Plan product</p>';
}
function panam_booty_html()
{
    $value = get_option('panam_booty', '');
    echo '<input type="text" id="panam_booty" name="panam_booty" placeholder="Booty Plan ID (ex. 1,5,25)" value="' . $value . '" />';
    echo '<p class="description" id="timezone-description">Choose the ID of the Booty Plan product</p>';
}
function panam_recipes_html()
{
    $value = get_option('panam_recipes', '');
    echo '<input type="text" id="panam_recipes" name="panam_recipes" placeholder="25 recipes ID (ex. 1,5,25)" value="' . $value . '" />';
    echo '<p class="description" id="timezone-description">Choose the ID of the 25 Recipes product</p>';
} function panam_recipes_fruit_html(){    $value = get_option('panam_recipes_fruit', '');    echo '<input type="text" id="panam_recipes_fruit" name="panam_recipes_fruit" placeholder="25 recipes FRUIT ID (ex. 1,5,25)" value="' . $value . '" />'; echo '<p class="description" id="timezone-description">Choose the ID of the 25 FRUIT Recipes product</p>';}


// get range price for free delivery
if (!function_exists('get_free_delivery_price')) {
    function get_free_delivery_price()
    {
        switch (get_current_blog_id()) {
            default:
            	$free = get_option('woocommerce_free_shipping_2_settings');
                $free = $free['min_amount'];
                break;
            case '1':
                $free = get_option('woocommerce_free_shipping_2_settings');
                $free = $free['min_amount'];
                break;

            case '2':
                $free = get_option('woocommerce_free_shipping_2_settings');
                $free = $free['min_amount'];
                break;

            case '3':
                $free = get_option('woocommerce_free_shipping_2_settings');
                $free = $free['min_amount'];
                break;
            case '4':
                $free = get_option('woocommerce_free_shipping_2_settings');
                $free = $free['min_amount'];
                break;

            }

        return $free;
    }
}
add_action('woocommerce_cart_updated', 'fester_add_free_gift');
function fester_add_free_gift()
{
    $freefood                  = 0;
    $freegym                   = 0;
    $freeyoga                  = 0;
    $panam_booty               = 0;
    $panam_recipes             = 0;     $panam_recipesfruit             = 0;
    $cart_items_id             = array();
    $cart_items                = WC()->cart->get_cart();
    $fstr_subtotal             = WC()->cart->get_subtotal();
    $fstr_free_delivery_price  = get_free_delivery_price();
    $freegym                   = get_option('fstr_homegym');
    $freefood                  = get_option('fstr_food');
    $freeyoga                  = get_option('fstr_yoga');
    $freebootyplan             = get_option('panam_booty');
    $freerecipes               = get_option('panam_recipes'); $freerecipesfruit               = get_option('panam_recipes_fruit');
    $fstr_product_cart_id_gym       = WC()->cart->generate_cart_id($freegym);
    $fstr_product_cart_id_food      = WC()->cart->generate_cart_id($freefood);
    $fstr_product_cart_id_yoga      = WC()->cart->generate_cart_id($freeyoga);
    $fstr_product_cart_id_bootyplan = WC()->cart->generate_cart_id($freebootyplan);
    $fstr_product_cart_id_recipes   = WC()->cart->generate_cart_id($freerecipes);     $fstr_product_cart_id_recipes_fruit   = WC()->cart->generate_cart_id($freerecipesfruit);

    if (!WC()->cart->find_product_in_cart($fstr_product_cart_id_food)) {
        if ($fstr_subtotal > 0) {
            WC()->cart->add_to_cart($freefood);
        }
    }
    if (!WC()->cart->find_product_in_cart($fstr_product_cart_id_yoga)) {

        foreach (WC()->cart->get_cart() as $cart_item_fstr) {
            //$iswell = get_post_meta($cart_item_fstr['product_id'], 'iswell', true);
			$iswell = get_post_meta( $cart_item_fstr['product_id'], '_sku', true );
			$iswell2 = get_post_meta( $cart_item_fstr['variation_id'], '_sku', true );

			//echo '<p>'.$iswell.$iswell2.'</p>';
			//$iswell = $product_fstr;
	if ($iswell=="WOW-P-DTXWNS" || $iswell=="WOW-T-WNS" || $iswell=="WOW-P-DTXWNSBTP" || $iswell=="WOW-P-SFWNSBTB" || $iswell=="WOW-P-WNSBTP" || $iswell=="WOW-P-WNSBTB" || $iswell2=="WOW-P-DTXWNS" || $iswell2=="WOW-T-WNS" || $iswell2=="WOW-P-DTXWNSBTP" || $iswell2=="WOW-P-SFWNSBTB" || $iswell2=="WOW-P-WNSBTP" || $iswell2=="WOW-P-WNSBTB" || $iswell=="WOW-P-SFDTXWNSBTBBTP" || $iswell=="WOW-T-SWT" || $iswell=="WOW-P-SWTBTY" || $iswell=="WOW-P-SETSWTBTY" || $iswell=="WOW-P-SSTSWTBTY" || $iswell=="WOW-P-SETSWT" || $iswell=="WOW-P-SSTSWT" || $iswell2=="WOW-T-SWT" || $iswell2=="WOW-P-SWTBTY" || $iswell2=="WOW-P-SETSWTBTY" || $iswell2=="WOW-P-SSTSWTBTY" || $iswell2=="WOW-P-SETSWT" || $iswell2=="WOW-P-SSTSWT") {
                WC()->cart->add_to_cart($freeyoga);
            }

        }
    }

    //Checking if there is a product in cart

    if (!WC()->cart->find_product_in_cart($fstr_product_cart_id_bootyplan)) {

        foreach (WC()->cart->get_cart() as $cart_item_fstr) {
           
            $isbooty = get_post_meta( $cart_item_fstr['product_id'], '_sku', true );
            $isbooty2 = strval(get_post_meta( $cart_item_fstr['variation_id'], '_sku', true ));

	if ($isbooty2=="WOW-S-BL1BL2" || $isbooty2=="WOW-P-SFSLFTBTBBL1BL2" || $isbooty2=="WOW-P-SFSLFTBL1BL2" || $isbooty=="WOW-S-BL1BL2" || $isbooty=="WOW-P-SFSLFTBTBBL1BL2" || $isbooty=="WOW-P-SFSLFTBL1BL2") {
                WC()->cart->add_to_cart($freebootyplan);
            }
        }
    }

    //25 recipes, check if Superfood added

    if (!WC()->cart->find_product_in_cart($fstr_product_cart_id_recipes)) {

        foreach (WC()->cart->get_cart() as $cart_item_fstr) {

            $isfood = strval(get_post_meta( $cart_item_fstr['product_id'], '_sku', true ));
            $isfood2 = strval(get_post_meta( $cart_item_fstr['variation_id'], '_sku', true ));
            $foodsku = 'SLFT';
if ($isfood){
	if (strpos($isfood, $foodsku) != false || strpos($isfood2, $foodsku) != false) {
                WC()->cart->add_to_cart($freerecipes);
            }
        }
        }
    }

    if (!WC()->cart->find_product_in_cart($fstr_product_cart_id_recipes_fruit)) {

        foreach (WC()->cart->get_cart() as $cart_item_fstr) {

            $isfruit = strval(get_post_meta( $cart_item_fstr['product_id'], '_sku', true ));
            $isfruit2 = strval(get_post_meta( $cart_item_fstr['variation_id'], '_sku', true ));
            $fruitsku = 'SFR';
if ($isfruit){
	if (strpos($isfruit, $fruitsku) != false || strpos($isfruit2, $fruitsku) != false) {
                WC()->cart->add_to_cart($freerecipesfruit);
            }
        }
        }
    }


    //Checking if available for free gym

    if (!WC()->cart->find_product_in_cart($fstr_product_cart_id_gym)) {
        if ($fstr_subtotal >= $fstr_free_delivery_price) {
            WC()->cart->add_to_cart($freegym);
        } else {
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                if ($cart_item['product_id'] == $freegym) {
                    WC()->cart->remove_cart_item($freegym);
                }
            }
        }

    }

}

add_action('woocommerce_cart_updated', 'fester_remove_free_gift');
function fester_remove_free_gift()
{
    $freegym                   = get_option('fstr_homegym');
    $freefood                  = get_option('fstr_food');
    $freeyoga                  = get_option('fstr_yoga');
    $freebootyplan             = get_option('panam_booty');
    $freerecipes             = get_option('panam_recipes');     $freerecipesfruit             = get_option('panam_recipes_fruit');
    $fstr_subtotal             = WC()->cart->get_subtotal();
    $fstr_free_delivery_price  = get_free_delivery_price();
    $fstr_product_cart_id_gym        = WC()->cart->generate_cart_id($freegym);
    $fstr_product_cart_id_food       = WC()->cart->generate_cart_id($freefood);
    $fstr_product_cart_id_yoga       = WC()->cart->generate_cart_id($freeyoga);
    $panam_product_cart_id_bootyplan = WC()->cart->generate_cart_id($freebootyplan);
    $panam_product_cart_id_recipes = WC()->cart->generate_cart_id($freerecipes);     $panam_product_cart_id_recipes_fruit = WC()->cart->generate_cart_id($freerecipesfruit);
    if ($fstr_subtotal == 0) {
        WC()->cart->remove_cart_item($freefood);
        WC()->cart->remove_cart_item($fstr_product_cart_id_food);
        WC()->cart->remove_cart_item($panam_product_cart_id_bootyplan);
        WC()->cart->remove_cart_item($panam_product_cart_id_recipes);
    }
    if ($fstr_subtotal < $fstr_free_delivery_price) {
        WC()->cart->remove_cart_item($freegym);
        WC()->cart->remove_cart_item($fstr_product_cart_id_gym);
    }
    $thereisnowell = 1;
    foreach (WC()->cart->get_cart() as $cart_item_fstr) {
        //if (get_post_meta($cart_item_fstr['product_id'], 'iswell', true)) {
		//$iswell = $cart_item_fstr->get_sku();
			$iswell = get_post_meta( $cart_item_fstr['product_id'], '_sku', true );
			$iswell2 = get_post_meta( $cart_item_fstr['variation_id'], '_sku', true );
	if ($iswell=="WOW-P-DTXWNS" || $iswell=="WOW-T-WNS" || $iswell=="WOW-P-DTXWNSBTP" || $iswell=="WOW-P-SFWNSBTB" || $iswell=="WOW-P-WNSBTP" || $iswell=="WOW-P-WNSBTB" || $iswell2=="WOW-P-DTXWNS" || $iswell2=="WOW-T-WNS" || $iswell2=="WOW-P-DTXWNSBTP" || $iswell2=="WOW-P-SFWNSBTB" || $iswell2=="WOW-P-WNSBTP" || $iswell2=="WOW-P-WNSBTB"  || $iswell=="WOW-P-SFDTXWNSBTBBTP" || $iswell=="WOW-T-SWT" || $iswell=="WOW-P-SWTBTY" || $iswell=="WOW-P-SETSWTBTY" || $iswell=="WOW-P-SSTSWTBTY" || $iswell=="WOW-P-SETSWT" || $iswell=="WOW-P-SSTSWT" || $iswell2=="WOW-T-SWT" || $iswell2=="WOW-P-SWTBTY" || $iswell2=="WOW-P-SETSWTBTY" || $iswell2=="WOW-P-SSTSWTBTY" || $iswell2=="WOW-P-SETSWT" || $iswell2=="WOW-P-SSTSWT") {
            $thereisnowell = 0;
        }
    }
    if ($thereisnowell) {
        WC()->cart->remove_cart_item($freeyoga);
        WC()->cart->remove_cart_item($fstr_product_cart_id_yoga);
    }
    //remove bootyplan if no booty combo
    // $thereisnobooty = 1;
    // foreach (WC()->cart->get_cart() as $cart_item_fstr) {
    //         $iswell = get_post_meta( $cart_item_fstr['product_id'], '_sku', true );
    //         $iswell2 = get_post_meta( $cart_item_fstr['variation_id'], '_sku', true );
    // if ($iswell=="BGC-P-BL1BL2" || $iswell=="WOW-P-SFSLFTBTBBL1BL2" || $iswell=="WOW-P-SFSLFTBL1BL2") {
    //         $thereisnowell = 0;
    //     }
    // }
    // if ($thereisnowell) {
    //     WC()->cart->remove_cart_item($freebootyplan);
    //     WC()->cart->remove_cart_item($panam_product_cart_id_bootyplan);
    // }

    $thereisnobooty = 1;
        foreach (WC()->cart->get_cart() as $cart_item_fstr) {
                $iswell   = get_post_meta( $cart_item_fstr['product_id'], '_sku', true );
                $iswell2  = get_post_meta( $cart_item_fstr['variation_id'], '_sku', true );
                $bootysku = 'BL1BL2';
    if (strpos($iswell, $bootysku) != false || strpos($iswell2, $bootysku) != false) {
        $thereisnobooty = 0;
            }
        }
    if ($thereisnobooty) {
        WC()->cart->remove_cart_item($freebootyplan);
        WC()->cart->remove_cart_item($panam_product_cart_id_bootyplan);
        }

    //remove recipes from cart if no food added

    $thereisnofood = 1;
    foreach (WC()->cart->get_cart() as $cart_item_fstr) {
            $isfood = get_post_meta( $cart_item_fstr['product_id'], '_sku', true );
            $isfood2 = get_post_meta( $cart_item_fstr['variation_id'], '_sku', true );
            $foodsku='SLFT';
    if (strpos($isfood, $foodsku) != false || strpos($isfood2, $foodsku) != false) {
            $thereisnofood = 0;
        }
    }
    if ($thereisnofood) {
        WC()->cart->remove_cart_item($freerecipes);
        WC()->cart->remove_cart_item($panam_product_cart_id_recipes);
    }

    $thereisnofruit = 1;
    foreach (WC()->cart->get_cart() as $cart_item_fstr) {
            $isfruit = get_post_meta( $cart_item_fstr['product_id'], '_sku', true );
            $isfruit2 = get_post_meta( $cart_item_fstr['variation_id'], '_sku', true );
            $fruitsku='SFR';
    if (strpos($isfruit, $fruitsku) != false || strpos($isfruit2, $fruitsku) != false) {
            $thereisnofruit = 0;
        }
    }
    if ($thereisnofruit) {
        WC()->cart->remove_cart_item($freerecipesfruit);
        WC()->cart->remove_cart_item($panam_product_cart_id_recipes_fruit);
    }

}