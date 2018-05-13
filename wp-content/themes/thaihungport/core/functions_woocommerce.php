<?php
/**
 * Created by PhpStorm.
 * User: Dao Quang DUng
 * Date: 30/12/2015
 * Time: 3:08 PM
 */

//* Add stock status to archive pages
function envy_stock_catalog() {
    global $product;
    if ( $product->is_in_stock() ) {
        echo '<div class="stock" >' . $product->get_stock_quantity() . __( ' in stock', 'envy' ) . '</div>';
    } else {
        echo '<div class="out-of-stock" >' . __( 'out of stock', 'envy' ) . '</div>';
    }
}

//* Add dimensions status to archive pages
function cj_show_dimensions() {
    global $product;
    $dimensions = $product->get_dimensions();
    if ( ! empty( $dimensions ) ) {
        echo  $dimensions;
    }
}

// get categori name product woocommerc
function wpa89819_wc_single_product(){

    $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );

    if ( $product_cats && ! is_wp_error ( $product_cats ) ){

        $single_cat = array_shift( $product_cats ); ?>

        <?php echo $single_cat->name; ?>

    <?php }
}

// lấy tên của product cat theo ID
function get_product_category_by_id( $category_id ) {
    $term = get_term_by( 'id', $category_id, 'product_cat', 'ARRAY_A' );
    return $term['name'];
}

function get_product_slug_category_by_id( $category_id ) {
    $term = get_term_by( 'id', $category_id, 'product_cat', 'ARRAY_A' );
    return get_term_link($term,'product_cat');
}

// lấy link của product cat theo ID
function get_product_category_link_by_id( $category_id ) {
    $term = get_term_by( 'id', $category_id, 'product_cat', 'ARRAY_A' );
    return $term['term_id'];
}


// thêm đơn vị đo tiền tệ
add_filter( 'woocommerce_currencies', 'add_my_currency' );
function add_my_currency( $currencies ) {
    $currencies['đ'] = __( 'Vietnam Dong', 'woocommerce' );
    return $currencies;
}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
function add_my_currency_symbol( $currency_symbol, $currency ) {
    switch( $currency ) {
        case 'đ': $currency_symbol = 'đ'; break;
    }
    return $currency_symbol;
}

function get_id_tax_product_on_single_product(){
    global $post;
    $terms = get_the_terms( $post->ID, 'product_cat' );
    foreach ($terms as $term) {
        $product_cat_id = $term->term_id;
        return $product_cat_id;
        break;
    }
}

// hộp xắp xếp

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php).
// Used in conjunction with https://gist.github.com/DanielSantoro/1d0dc206e242239624eb71b2636ab148

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;

    ob_start();

    ?>
    <a class="cart-customlocation" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></a>
    <?php

    $fragments['a.cart-customlocation'] = ob_get_clean();

    return $fragments;

}


add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );    // 2.1 +

function woo_archive_custom_cart_button_text() {

    return __( 'MUA HÀNG', 'woocommerce' );

}





