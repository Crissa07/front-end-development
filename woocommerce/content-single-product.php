<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

//defined( 'ABSPATH' ) || exit;


global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
//do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
 ?>
<?php
$product->get_id();
$sku = $product->get_sku();
$product_title = get_the_title();
$product_id = get_the_ID();
$_regular_price =  get_post_meta( get_the_ID(), '_regular_price', true);
$image_id = get_post_thumbnail_id(get_the_ID());
$alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);

$expert = get_field('excerpt' , get_the_ID());
$site_url = get_site_url();
// ACF field value

$product_shor_desc_1 = get_field( 'add_product_short_description_1' );
$product_shor_desc_2 = get_field( 'add_product_short_description_2' );
$product_link = get_the_permalink($product_id);
$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
$currancy_symbol =  get_woocommerce_currency_symbol();

//product images var

// Get the featured image URL
$featured_image_url = wp_get_attachment_url( $product->get_image_id() );

// Get the gallery image IDs
$gallery_image_ids = $product->get_gallery_image_ids();
$content_for_single_product_page = get_field('content_for_single_product_page', 'option');

?>

<section class="product-details-section">
	<div class="container">
		
		<?php
    global $post;
    
    // Get product categories
    $terms = get_the_terms( $post->ID, 'product_cat' );
    
    // Get parent and child category names
    $parent_cat_name = '';
    $parent_cat_link = '';
    $child_cat_name = '';
    $child_cat_link = '';
    if ( $terms && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            if ( $term->parent == 0 ) {
                $parent_cat_name = $term->name;
                $parent_cat_link = get_term_link( $term->term_id, 'product_cat' );
            } else {
                $child_cat_name = $term->name;
                $child_cat_link = get_term_link( $term->term_id, 'product_cat' );
            }
        }
    }
    
    // Get product title
    $product_title = get_the_title( $post->ID );
?>
<?php woocommerce_output_all_notices(); ?>
<div class="product-breadcrumb">
    <ul>
        <li><a href="<?php echo get_site_url(); ?>">Home</a></li>
        <li><a href="<?php echo $parent_cat_link; ?>"><?php echo $parent_cat_name; ?></a></li>
        <li><a href="<?php echo $child_cat_link; ?>"><?php echo $child_cat_name; ?></a></li>
        <li><a class="main-page-title" href=""><?php echo $product_title; ?></a></li>
    </ul>
</div>

		<div class="row">
			<div class="col-md-6">
				<div class="product-main-img">
					<div class="product-main-slide">
					<?php if ( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ): ?>
                        <?php if( !empty( $featured_image_url ) ){ ?>
                            <div class="product-main-item">
                                <img src="<?php echo $featured_image_url;?>" class="img-fluid" alt="<?php echo $alt_text;?>" title="<?php echo $product->get_name();?>" >
                            </div>
                            <?php }else{ ?>
                             <div class="product-main-item">
                                <img src="<?php echo  $site_url.'/wp-content/uploads/woocommerce-placeholder.png'; ?>" alt="woocommerce-product-gallery__image--placeholder">
                            </div>
                        <?php } ?>
                        <?php if ( !empty( $gallery_image_ids ) ){
                            foreach ( $gallery_image_ids as $gallery_image_id ) {
                            	
                                 $gallery_image_url = wp_get_attachment_url( $gallery_image_id );
                                 $gallery_img_alt_text = get_post_meta($gallery_image_id , '_wp_attachment_image_alt', true);?>
                            <div class="product-main-item" >
                                <img src="<?php echo $gallery_image_url; ?>" class="img-fluid" alt="<?php echo $gallery_img_alt_text; ?>" title="<?php echo $product->get_name();?>">
                            </div>

                        <?php 
                        
                            }
                        }?>
                    <?php endif; ?>
                    
                    </div>
					
					<div class="product-maintext">
						<?php 
						$recyclable_text = get_field('content_for_single_product_recyclable', 'option');
						if(!empty($recyclable_text)){
						?>
						<span><?php echo $recyclable_text ?></span>
						<svg id="reuse-svgrepo-com" xmlns="http://www.w3.org/2000/svg" width="22.949" height="23.566" viewBox="0 0 22.949 23.566">
						  <path id="Path_67" data-name="Path 67" d="M1.627,12.007A9.733,9.733,0,0,1,7.713,4.5l-.147.265a.789.789,0,0,0,.271,1.054.717.717,0,0,0,.37.1.736.736,0,0,0,.643-.386L9.873,3.691a.8.8,0,0,0,.074-.585A.768.768,0,0,0,9.6,2.637L7.831,1.573a.726.726,0,0,0-1.013.282.788.788,0,0,0,.271,1.054l.185.111A11.262,11.262,0,0,0,.166,11.739a11.755,11.755,0,0,0,.49,5.843.744.744,0,0,0,.7.507.715.715,0,0,0,.254-.047.78.78,0,0,0,.443-.989A10.152,10.152,0,0,1,1.627,12.007Z" transform="translate(0 -1.469)" fill="#272727"/>
						  <path id="Path_68" data-name="Path 68" d="M40.786,179.112a.722.722,0,0,0-1.045.094,9.158,9.158,0,0,1-13.183,1.27H26.8a.772.772,0,0,0,0-1.543H24.822a.72.72,0,0,0-.546.177.778.778,0,0,0-.261.514v0h0c0,.022,0,.044,0,.067,0,0,0,.008,0,.012v2.126a.757.757,0,0,0,.741.772h0a.757.757,0,0,0,.742-.771v-.269a10.734,10.734,0,0,0,5.145,2.51,10.4,10.4,0,0,0,1.878.171,10.777,10.777,0,0,0,8.359-4.045A.793.793,0,0,0,40.786,179.112Z" transform="translate(-21.636 -160.677)" fill="#272727"/>
						  <path id="Path_69" data-name="Path 69" d="M131.427,25.276a.726.726,0,0,0-1.013-.282l-.244.146c.01-.055.022-.109.031-.163a11.615,11.615,0,0,0-1.8-8.467,10.787,10.787,0,0,0-7.032-4.659.745.745,0,0,0-.859.626.769.769,0,0,0,.6.894,9.318,9.318,0,0,1,6.075,4.025,10.034,10.034,0,0,1,1.562,7.3l-.109-.2a.726.726,0,0,0-1.013-.283.788.788,0,0,0-.272,1.054l1.022,1.842a.746.746,0,0,0,.45.359.716.716,0,0,0,.563-.077l1.771-1.063A.789.789,0,0,0,131.427,25.276Z" transform="translate(-108.578 -10.773)" fill="#272727"/>
						</svg>
						<?php } ?>
					</div>
				</div>
				<div class="product-thumbnail">
					<?php if ( $product->is_type( 'simple' ) || $product->is_type( 'variable' )): ?>
                        <?php if( !empty( $featured_image_url ) ){ ?>
                            <div class="product-thumbnail-item">
                                <img src="<?php echo $featured_image_url;?>" class="img-fluid" alt="<?php echo $alt_text;?>" title="<?php echo $product->get_name();?>">
                            </div>
                            <?php }else{ ?>
                             <div class="product-thumbnail-item">
                                <img src="<?php echo  $site_url.'/wp-content/uploads/woocommerce-placeholder.png'; ?>" alt="woocommerce-product-gallery__image--placeholder">
                            </div>
                        <?php } ?>
                        <?php if ( !empty( $gallery_image_ids ) ){
                            foreach ( $gallery_image_ids as $gallery_image_id ) {
                                 $gallery_image_url = wp_get_attachment_url( $gallery_image_id );
                                 $gallery_img_alt_text = get_post_meta($gallery_image_id , '_wp_attachment_image_alt', true);?>
                            <div class="product-thumbnail-item">
                                <img src="<?php echo $gallery_image_url; ?>" class="img-fluid" alt="<?php echo $gallery_img_alt_text; ?>" title="<?php echo $product->get_name();?>">
                            </div>

                        <?php 
                        
                            }
                        }?>
                    <?php endif; ?>
                    
					
				</div>
				<div class="icon-count-bar-mobile">
					<?php do_action('woocmmerce_product_badges');?>
				</div>

			</div>
			<div class="col-md-6">
				<div class="product-details-in">
				<div class="product-details-area">
					<?php 
						echo do_shortcode( '[rating_snippet]' );
						?>
					</div>
					<?php if( !empty($product_title) ): ?>
                    	<h1><?php echo $product_title; ?></h1>
                    <?php endif; ?>

                    <?php if ( $product->is_type( 'variable' ) ){ ?>

                    <?php if ( is_user_logged_in() ) { ?>	
					<div class="select-sizes">
					
					<?php
					if ( $product->is_type( 'variable' ) ) {
					    $variations = $product->get_available_variations();
					    if ( ! empty( $variations ) ) {
					        $output = '';
					        $attributes = $product->get_variation_attributes();
					        foreach ( $attributes as $attribute_name => $options ) {
					            $taxonomy = 'pa_' . sanitize_title( $attribute_name );
					            $label = wc_attribute_label( $attribute_name, $product );
					            $lowercase_label = strtolower($label);
					            $output .= '<p class="attribute-title"> Select your ' . esc_html( $label ) . '</p>';
					            // Sort the options from smallest to largest
					            // Sort options based on variation size
						            usort($options, function ($a, $b) {
						                $a_size = preg_replace("/[^0-9.]/", "", $a);
						                $b_size = preg_replace("/[^0-9.]/", "", $b);

						                // Convert size to grams if specified in kilograms
						                if (strpos($a, 'kg') !== false) {
						                    $a_size *= 1000;
						                }
						                if (strpos($b, 'kg') !== false) {
						                    $b_size *= 1000;
						                }

						                return $a_size - $b_size;
						            });
					            foreach ( $options as $option ) {
					                $matched_variations = array_filter( $variations, function( $variation ) use ( $attribute_name, $option ) {
					                    $attribute_value = $variation['attributes']['attribute_' . sanitize_title( $attribute_name )];
					                    return $attribute_value === $option;
					                } );
					                if ( ! empty( $matched_variations ) ) {

					                	// echo '<pre>';
					                	// print_r($matched_variations);
					                	// echo '</pre>';
					                    $variation = reset( $matched_variations );
					                	// echo $variation['availability_html'];
					                    $variation_id = $variation['variation_id'];
					                    $variation_price = $variation['display_price'];
					                    $variation_price_html = wc_price( $variation_price );
					                    //echo $variation_price_html;
					                    $variation_desc = $variation['variation_description'];
					                    $variation_image_src = wp_get_attachment_image_src( $variation['image_id'], 'full' )[0];
					                    $currancy_symbol2 =  get_woocommerce_currency_symbol();
					                    $variation_weight = $variation['weight'];
					                    $radio_id = 'variation_radio_' . $variation_id;
					                    $radio_name = 'attribute_' . sanitize_title( $label );
					                    $string_num = preg_replace("/[a-zA-Z]+/", "", $option);
					                    $kg_string_num = str_replace("-",".", $string_num);
					                    // echo $kg_string_num;
					                    $custom_field_value = get_post_meta( $variation_id, '_custom_field_variation', true );
					                    $variation_sku = $variation['sku'];

										$curl = curl_init();

										curl_setopt_array($curl, array(
										  CURLOPT_URL => 'http://102.2232.60.242:8080/api/batch/'.$variation_sku.'',
										  CURLOPT_RETURNTRANSFER => true,
										  CURLOPT_ENCODING => '',
										  CURLOPT_MAXREDIRS => 10,
										  CURLOPT_TIMEOUT => 0,
										  CURLOPT_FOLLOWLOCATION => true,
										  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
										  CURLOPT_CUSTOMREQUEST => 'GET',
										  CURLOPT_HTTPHEADER => array(
										    'Authorization: jk&*(^&IYHkjhgJgf55'
										  ),
										));

										$response = curl_exec($curl);

										curl_close($curl);
										$skures = json_decode($response, true);										

					                    if ( ! empty( $variation_weight ) ) {
							                $per_kg_price = ($variation_price * 1000) / ( $kg_string_num * 1000);
							                //$per_kg_price_rounded = round($per_kg_price, 2);
							                $per_kg_price_html = wc_price( $per_kg_price );
							            } else {
							                $per_kg_price_html = '-';
							            }

							            $remove_hyphen_option = str_replace("-",".",$option);
							            $num_formatted = number_format($per_kg_price, 2);
							            $stock_status = get_post_meta($variation_id, '_stock_status', true);
                    					$stock_status_text = ($stock_status === 'instock') ? 'In Stock' : 'Out of Stock';
					                    $output .= '<div class="select-sizes-item" for="' . esc_attr( $radio_id ) . '">';
					                    $output .= '<input data-stock-status="'.$stock_status_text.'" class="variation-btn" data-variation-sku-id="'.$variation_sku.'" data-variation-sku="'.$skures['response'].'" data-rrpprice="'.$custom_field_value.'" data-variation-kg="'.$currancy_symbol2.$per_kg_price.'" data-variation-id="'.$variation_id.'" 
					                    		data-price="'.esc_attr($variation_price_html).'" data-img="'.esc_attr( $variation_image_src ).'" type="radio" id="' . esc_attr( $radio_id ) . '" name="' . esc_attr( $lowercase_label ) . '" value="' . esc_attr( $remove_hyphen_option ) . '" data-per-price="'.$per_kg_price.'">';
					                    $output .= '<label class="variation-name">' . esc_html( $remove_hyphen_option ) . '</label>';
					                    $output .= '</div>';
					                }
					            }
					        }
					        echo '<div class="variation-radios">' . $output . '</div>';
					    }
					}
					?>

					
					</div>
					<?php } ?>
					
					<?php }?>
					<script>
						jQuery(document).ready(function($) {
							// Get the value of the attribute_pa_sizes parameter from the URL
							var urlParams = new URLSearchParams(window.location.search);
							var attributeValue = urlParams.get('attribute_pa_sizes');

							// Trigger the change event on the radio input with the matching value
							if (attributeValue) {
								var radioInput = $('input.variation-btn[value="' + attributeValue + '"]');
								if (radioInput.length) {
									radioInput.prop('checked', true);
									radioInput.trigger('change');
								}
							} else {
								$('input[type="radio"]:first').prop('checked', true);
								// Trigger the change event on the first radio button
								$('input[type="radio"]:first').trigger('change');
							}

							function handleVariationChange() {
								// get the value of the selected input radio
								var selectedValue = $(this).val();
								// get the data-img attribute value of the selected input radio
								var dataImg = $(this).data('img');
								var dataVarid = $(this).data('variation-id');
								var dataPrice = $(this).data('price');
								var dataPerkg = $(this).data('variation-kg');
								var dataPerprice = $(this).data('per-price');
								var dataRrpprice = $(this).data('rrpprice');
								var databbedate = $(this).data('variation-sku');

								//joinlist setting

								$('.cust-stock-block .wcwl_optin input').attr('name', 'wcwl_optin_'+dataVarid);
								$('.cust-stock-block .wcwl_optin input').attr('id', 'wcwl_optin_'+dataVarid);
								$('.cust-stock-block .wcwl_optin label').attr('for', 'wcwl_optin_'+dataVarid);
								$('.cust-stock-block .wcwl_email_elements label').attr('for', 'wcwl_email_'+dataVarid);
								$('.cust-stock-block .wcwl_email_elements input').attr('id', 'wcwl_email_'+dataVarid);
								$('.cust-stock-block .wcwl_control').attr('data-product-id', dataVarid);

								// update the src attribute value of all img tags inside .product-img div with the data-img attribute value of the selected input radio
								$('.product-main-slide .product-main-item:nth-child(1) img').attr('src', dataImg);
								$('.product-thumbnail .product-thumbnail-item:nth-child(1) img').attr('src', dataImg);

								$('.product-main-slide .product-main-item:nth-child(1) picture source').attr('srcset', dataImg);
								$('.product-thumbnail .product-thumbnail-item:nth-child(1) picture source').attr('srcset', dataImg);

								$('.single_add_to_cart_button').val(dataVarid);
								$('.price_pr_slide').html('<span>' + dataPrice + '</span>');
								$('.variation-bbe').text(databbedate);

								$('.tooltipsku i').show();

								if (!databbedate) {
									$('.tooltipsku i').hide();
								}

								if (dataRrpprice != '') {
									$('.rrp-price').text('RRP £' + dataRrpprice + '');
								} else {
									$('.rrp-price').text('');
								}
								var datastockstatus = $(this).data('stock-status');
								if( datastockstatus === 'Out of Stock'  ){
									$('#wc-stripe-payment-request-wrapper iframe,.quantity input,.single_add_to_cart_button').css('cursor','not-allowed');
									$('.product-btn').css('display','none');
									$('.cust-stock-block').css('display','block');
									$('.cust-stock').text(datastockstatus);
									$('.StripeElement').addClass('stripe-none');
									$('.cust-stock-block .wcwl_optin input,.cust-stock-block .wcwl_control button').css('cursor','pointer');
									$('.cust-stock-block p.stock.out-of-stock').text('Out of stock').css('color','red');
								}else{
									$('#wc-stripe-payment-request-wrapper iframe,.quantity input,.single_add_to_cart_button').css('cursor','pointer');
									$('.product-btn').css('display','block');
									$('.cust-stock-block').css('display','none');
									$('.cust-stock').text('');
									$('.cust-stock-block .wcwl_optin input,.cust-stock-block .wcwl_control button').css('cursor','not-allowed');
									$('.cust-stock-block p.stock.out-of-stock').text('In stock').css('color','green');
									$('.StripeElement').removeClass('stripe-none');
								}

								if (dataPerprice > 0 && dataPerprice < 1) {
									//console.log(dataPerkg);
									var dataPerkgNew = dataPerkg.replace('£', '');
									var price_in_kg = (dataPerkgNew*1000);
									var per_kg_price_gm = parseFloat(price_in_kg);
									var price_two_digits = per_kg_price_gm.toFixed(2);
									//console.log(dataPerkgNew);
									$('.variation-per-kg').html('<span>£' + price_two_digits + ' per kg </span>');
								} else {
									var rem_sym_price = dataPerkg.replace("£", "");
									console.log(dataPerkg);
									var per_kg_price = parseFloat(rem_sym_price);
									var dataperkg_digit = per_kg_price.toFixed(2);
									$('.variation-per-kg').html('<span>£' + dataperkg_digit + ' per kg </span>');
								}
							}

							$('input.variation-btn').change(handleVariationChange);

							// Trigger the change event for radioInput on window load
							if (attributeValue && radioInput.length) {
								radioInput.change();
							}
							else {
							$('input[type="radio"]:first').change();
							}
						});
						</script>
					<?php if ( $product->is_type( 'variable' ) && is_user_logged_in() ){ ?>
						<div class="beforetool">
							<div class="tooltipsku">
								<i class="fas fa-info-circle" style="display: none;"></i>
								<span class="tooltiptext">Best before dates shown are of current batches. Batches can change quickly in between time of purchase and shipping the product. Normally, BBE's will increase with newer batches but can't be guaranteed. <br/>Best Before Dates are an estimation of when quality might start to reduce and is not related to food safety. If stored correctly products should last longer.</span>
								
							</div>
							<p class="variation-bbe"></p>
						</div>
					<?php } ?>
					<?php if ( $product->is_type( 'simple' ) ){ ?>
					<?php 
						$curl = curl_init();

						curl_setopt_array($curl, array(
						  CURLOPT_URL => 'http://109.228.60.238:8080/api/batch/'.$sku.'',
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'GET',
						  CURLOPT_HTTPHEADER => array(
						    'Authorization: jk&*(^&IYHkjhgJgf55'
						  ),
						));

						$response = curl_exec($curl);

						curl_close($curl);
						$skures = json_decode($response, true);
						
						//echo $skures['response'];

					?>
					<?php if ( is_user_logged_in() ) { ?>
					<?php if(!empty($skures['response'])): ?>
						<div class="beforetool">
							<div class="tooltipsku">
								<i class="fas fa-info-circle"></i>
								<span class="tooltiptext">Best before dates shown are of current batches. Batches can change quickly in between time of purchase and shipping the product. Normally, BBE's will increase with newer batches but can't be guaranteed. <br/>Best Before Dates are an estimation of when quality might start to reduce and is not related to food safety. If stored correctly products should last longer.</span>
								
							</div>
							<p><?php echo $skures['response']; ?></p>
						</div>
					<?php endif; ?>
					<?php } ?>
					<?php } ?>
					<?php if(is_user_logged_in()){ ?>
					<div class="product-price">
						
						<label class="price_pr_slide <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></label>

						<?php 
						$product_weight = $product->get_weight(); // Get product weight
					    $product_price = $product->get_price(); // Get product price

					    if ( ! empty( $product_weight ) && ! empty( $product_price ) && is_user_logged_in() ) {
					        $price_per_kg = $product_price / $product_weight;
					        $price = '<span class="price-per-kg">' . wc_price( $price_per_kg ) . ' per kg</span>' . $price;
					        echo '<span>'.$price.'</span>';
					    }
						?>
						<?php 

						if ( $product->is_type( 'variable' ) && is_user_logged_in() ) {

							echo '<span class="variation-per-kg">Select to see per kg price</span>';
						}?>
						<?php 
						$rrp_price = get_post_meta($product_id , '_custom_field', true);
						if ( $product->is_type( 'simple' ) && is_user_logged_in() ) {
						?>
							<?php if(!empty($rrp_price)){ ?>
								<span>RRP £<?php echo $rrp_price; ?></span>
							<?php } ?>
						<?php }?>
						<?php if ( $product->is_type( 'variable' ) && is_user_logged_in() ) {?>
							<span class="rrp-price">Select to see RRP price</span>
						<?php }?>
					</div>
					<?php } ?>
					<div class="beneathdesc"><?php echo $content_for_single_product_page;  ?></div>

					<?php
					if ( !is_user_logged_in() ) {
					$wholesaletext = get_option( 'wcwp_hide_prices_text', '' );
					?>
					<div class="wholesalesec product-details-page">
						<?php echo $wholesaletext; ?>
					</div>
					<?php } ?>
					<?php 
					if ( is_user_logged_in() && $product->is_type( 'variable' )) {?>
						<style>
							.cust-stock-block p.stock.out-of-stock:nth-child(2) {
    							display: none;
							}
							.StripeElement{
								position: relative;
							}
							.StripeElement.stripe-none:before {
							    content: '';
							    position: absolute;
							    width: 100%;
							    height: 100%;
							    background: transparent;
							    z-index: 1;
							    border-radius: 5px;
							    cursor: not-allowed;
							}
						</style>
						<div class="cust-stock-block" style="display: none;">
							<p class="stock out-of-stock">Out of stock</p>
						<?php 
							echo wc_get_stock_html( $product );
						?>
						</div>
					<?php }?>
					<?php 
					if ( is_user_logged_in()) {

						if ( ! $product->is_in_stock() && $product->is_type( 'simple' ) ) {
							global $product;
							echo wc_get_stock_html( $product );
						}
						// if ( ! $product->is_in_stock() && $product->is_type( 'variable' ) ) {
						// 	global $product;
						// 	echo wc_get_stock_html( $product );
						// }
						?>
						<?php
						if($product->is_type( 'simple' )){
							echo do_shortcode( '[woocommerce_waitlist product_id=' . get_the_ID() . ']' );
						} 
						?>

					<div class="product-btn testing">
						<?php
						if ( $product->is_in_stock() ) { ?>

						<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

						<form class="cart product-addtocar" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
							<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

							<?php
							do_action( 'woocommerce_before_add_to_cart_quantity' );

							woocommerce_quantity_input(
								array(
									'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
									'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
									'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
								)
							);

							do_action( 'woocommerce_after_add_to_cart_quantity' );
							?>

							<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt btn btn-light-green"><?php echo esc_html( $product->single_add_to_cart_text() ); ?><svg xmlns="http://www.w3.org/2000/svg" width="25.003" height="21.912" viewBox="0 0 25.003 21.912">
												  <path id="basket-svgrepo-com" d="M22.864,6.533H20.18L16.152.485A1.089,1.089,0,0,0,14.34,1.693l3.224,4.84H6.389l3.227-4.84A1.089,1.089,0,0,0,7.8.485L3.773,6.533H1.089a1.089,1.089,0,1,0,0,2.178H2.178v8.71a3.266,3.266,0,0,0,3.266,3.266H18.509a3.266,3.266,0,0,0,3.266-3.266V8.71h1.089a1.089,1.089,0,0,0,0-2.178ZM19.6,17.421a1.089,1.089,0,0,1-1.089,1.089H5.444a1.089,1.089,0,0,1-1.089-1.089V8.71H19.6ZM6.533,15.787V11.432a1.089,1.089,0,0,1,2.178,0v4.355a1.089,1.089,0,0,1-2.178,0Zm4.355,0V11.432a1.089,1.089,0,1,1,2.178,0v4.355a1.089,1.089,0,1,1-2.178,0Zm4.355,0V11.432a1.089,1.089,0,0,1,2.178,0v4.355a1.089,1.089,0,0,1-2.178,0Z" transform="translate(0 1.254) rotate(-3)" fill="#fff"/>
												</svg>
											</button>

							<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
						</form>
								

						<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

					<?php } ?>	

					
					</div>
					<?php } ?>
				</div>
			</div>
			</div>
		</div>
		<div class="woocommerce"> 
			<div class="product">
		<div class="product-inner woocommerce-product-gallery desktop-view">
			<?php do_action('woocmmerce_product_badges');?>
			<div class="social-media-box">
				<ul>
					<li>
						<a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" width="17.645" height="17.538" viewBox="0 0 17.645 17.538">
							  <path id="Icon_awesome-facebook" data-name="Icon awesome-facebook" d="M18.207,9.385A8.822,8.822,0,1,0,8.006,18.1V11.935H5.765V9.385H8.006V7.441a3.113,3.113,0,0,1,3.332-3.432,13.578,13.578,0,0,1,1.975.172v2.17H12.2a1.275,1.275,0,0,0-1.438,1.378V9.385H13.21l-.391,2.55H10.763V18.1A8.826,8.826,0,0,0,18.207,9.385Z" transform="translate(-0.563 -0.563)" fill="#272727"/>
							</svg>
						</a>
					</li>
					<li>
						<a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" width="18.214" height="14.793" viewBox="0 0 18.214 14.793">
							  <path id="Icon_awesome-twitter" data-name="Icon awesome-twitter" d="M16.342,7.067c.012.162.012.324.012.485A10.548,10.548,0,0,1,5.732,18.174,10.549,10.549,0,0,1,0,16.5a7.723,7.723,0,0,0,.9.046A7.476,7.476,0,0,0,5.536,14.95a3.74,3.74,0,0,1-3.49-2.589,4.708,4.708,0,0,0,.705.058,3.948,3.948,0,0,0,.982-.127A3.733,3.733,0,0,1,.74,8.628V8.581a3.759,3.759,0,0,0,1.687.474A3.739,3.739,0,0,1,1.271,4.063a10.611,10.611,0,0,0,7.7,3.906,4.214,4.214,0,0,1-.092-.855,3.737,3.737,0,0,1,6.46-2.554,7.349,7.349,0,0,0,2.369-.9,3.723,3.723,0,0,1-1.641,2.057,7.483,7.483,0,0,0,2.15-.578,8.024,8.024,0,0,1-1.872,1.93Z" transform="translate(0 -3.381)" fill="#272727"/>
							</svg>
						</a>
					</li>
					<li>
						<a href="https://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&description=<?php echo urlencode(get_the_title()); ?>" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" width="17.645" height="17.645" viewBox="0 0 17.645 17.645">
							  <path id="Icon_awesome-pinterest" data-name="Icon awesome-pinterest" d="M17.645,9.385A8.824,8.824,0,0,1,6.211,17.813a9.917,9.917,0,0,0,1.1-2.312c.107-.413.548-2.1.548-2.1a2.363,2.363,0,0,0,2.021,1.014c2.661,0,4.578-2.448,4.578-5.489A5.178,5.178,0,0,0,9.015,3.832c-3.806,0-5.831,2.554-5.831,5.34A3.959,3.959,0,0,0,4.973,12.59c.167.078.256.043.3-.117.028-.121.178-.722.245-1a.264.264,0,0,0-.06-.253A3.474,3.474,0,0,1,4.8,9.207,3.818,3.818,0,0,1,8.787,5.379a3.483,3.483,0,0,1,3.686,3.589c0,2.387-1.206,4.041-2.775,4.041a1.28,1.28,0,0,1-1.306-1.594,17.728,17.728,0,0,0,.729-2.938A1.108,1.108,0,0,0,8,7.236c-.886,0-1.6.914-1.6,2.142a3.179,3.179,0,0,0,.263,1.309S5.8,14.38,5.639,15.07A8.54,8.54,0,0,0,5.607,17.6,8.823,8.823,0,1,1,17.645,9.385Z" transform="translate(0 -0.563)" fill="#272727"/>
							</svg>
						</a>
					</li>
					<li>
						<a href="https://mail.google.com/mail/?view=cm&fs=1&su=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" width="18.214" height="13.661" viewBox="0 0 18.214 13.661">
							  <path id="Icon_awesome-envelope" data-name="Icon awesome-envelope" d="M17.869,9.011a.214.214,0,0,1,.345.167v7.275a1.708,1.708,0,0,1-1.708,1.708H1.708A1.708,1.708,0,0,1,0,16.453V9.182a.213.213,0,0,1,.345-.167c.8.619,1.853,1.405,5.482,4.041.751.548,2.017,1.7,3.28,1.693,1.27.011,2.561-1.167,3.284-1.693C16.019,10.42,17.072,9.63,17.869,9.011Zm-8.762,4.6c.825.014,2.014-1.039,2.611-1.473,4.721-3.426,5.08-3.725,6.169-4.578a.851.851,0,0,0,.327-.672V6.208A1.708,1.708,0,0,0,16.507,4.5H1.708A1.708,1.708,0,0,0,0,6.208v.676a.856.856,0,0,0,.327.672c1.089.85,1.448,1.153,6.169,4.578C7.094,12.568,8.282,13.621,9.107,13.607Z" transform="translate(0 -4.5)" fill="#272727"/>
							</svg>
						</a>
					</li>
				</ul>
			</div>
		</div>
		</div>
	</div>
		<div class="product-description">
			
		<?php
		$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

		if ( ! empty( $product_tabs ) ) : ?>

			<div class="woocommerce-tabs wc-tabs-wrapper">
				<div class="description-tab">
					<ul class="tabs wc-tabs nav nav-pills" id="pills-tab" role="tablist">
						<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
							<li class="<?php echo esc_attr( $key ); ?>_tab nav-link" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
								<a href="#tab-<?php echo esc_attr( $key ); ?>">
									<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="product-description-content">
					<div class="tab-content" id="pills-tabContent">
					<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
						<div class="tab-pane fade woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
							<div class="description-content-text">
								<div class="js-close-tab clx"><i class="icon-chevron-left"></i><span>Back</span></div>
							<?php
							if ( isset( $product_tab['callback'] ) ) {
								call_user_func( $product_tab['callback'], $key, $product_tab );
							}
							?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php do_action( 'woocommerce_product_after_tabs' ); ?>
			</div>
		</div>

		<?php endif; ?>
	</div>
	
		<div class="you-might-also-like">
			<div class="you-might-also-title">
				<?php
				$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'You might also like', 'woocommerce' ) );

				if ( $heading ) :
					?>
					<h2><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>
			</div>
			<div class="row sliderin">
				<?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'post__not_in' => array(get_the_ID()),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'term_id',
                            'terms' => wp_get_post_terms(get_the_ID(), 'product_cat', array('fields' => 'ids')),
                            'operator' => 'IN'
                        )
                    )
                );
                $related_products = new WP_Query($args);

                if ($related_products->have_posts()) : ?> 
                    <?php while ($related_products->have_posts()) : $related_products->the_post(); 

                        $image = get_the_post_thumbnail_url($related_products->post->ID , 'medium ') ;
                     $expert = get_field('excerpt' , get_the_ID());
                      $title  = get_the_title();
                      $product_id = get_the_ID();
                      $price = get_post_meta( $product_id, '_price', true );
                      $rrp_price = get_post_meta( $product_id, '_custom_field', true );
                      $_regular_price =  get_post_meta( get_the_ID(), '_regular_price', true);
                      $image_id = get_post_thumbnail_id(get_the_ID());
                      $alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);
                      $currancy_symbol =  get_woocommerce_currency_symbol();

                        ?>
				<div class="col-lg-3 col-md-6">
	                <div class="view-products-img">
	                	<?php  if( $image) {?>
                                <a href= "<?php  echo get_the_permalink($product_id); ?>">   
                                    <img src="<?php echo  $image; ?>" class="img-fluid" alt="<?php echo $alt_text ; ?>">
                                </a>
                             <?php } else {?>
                                <a href= "<?php  echo get_the_permalink($product_id); ?>">  
                                    <img src="<?php echo  $site_url.'/wp-content/uploads/woocommerce-placeholder.png'; ?>" class="img-fluid" alt="dummy"> 
                                </a>
                         <?php } ?>
	                </div>
	                <div class="view-products-content">
	                	<?php 
						echo do_shortcode( '[rating_snippet]' );
						?>
	                  
	                  <a href= "<?php  echo get_the_permalink($product_id); ?>"> 
                        	<h5> <?php  echo  $title ;   ?></h5> 
                    	</a>
                    	<?php
                    	if ( is_user_logged_in() ) {
                    		global $product;
    						$product = wc_get_product( $product_id );
    						
						    echo '<span class="product post-'.$product_id.'"><span class="price">'.$product->get_price_html().'</span>'.$simple_rrp.'';
						    if (!empty($rrp_price)) {
						    	echo '<div class="rrp-price-loop" style="display:none;">RRP '.$currancy_symbol.$rrp_price.'</div></span>';
						    }
						    ?>
						    <script>
						    jQuery(document).ready(function(){
						      jQuery('.product.post-<?php echo $product_id; ?> span.price').append('<span class="simple-rrp-price"></span>' );
						      simpe_rrp_price = jQuery('.product.post-<?php echo $product_id; ?> .rrp-price-loop').text();
						      if(simpe_rrp_price != ''){
						      jQuery('.product.post-<?php echo $product_id; ?> span.price span.simple-rrp-price').text(' | '+simpe_rrp_price);
						  	}
						    });
						  </script>
						    <?php 
						    if ($product && $product->is_type('variable')) {
   									 woocommerce_variable_add_to_cart();
							}
							if ($product && $product->is_type('simple')) {
   									 woocommerce_template_loop_add_to_cart();
							}


						} else {?>
						    <?php
							$wholesaletext = get_option( 'wcwp_hide_prices_text', '' );
							?>
							<div class="wholesalesec product-details-page">
								<?php echo $wholesaletext; ?>
							</div>
							
						<?php }?>

	                  
	                  
	                </div>
	            </div>
	            <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>

                <?php endif; ?>
			</div>
		</div>
	</div>
</section>

<style>
	.wcwl_notice.woocommerce-message {
    display: none !important;
}
	.fade:not(.show) {
    opacity: 1;
}
.description-tab ul li {
    height: unset !important;
    line-height: 50px!important;
    background: rgba(194,70,144,.18)!important;
    border-radius: 7px 7px 0 0!important;
    padding: 0 25px!important;
    font-size: 16px!important;
    font-weight: 400!important;
    color: #272727!important;
        border: 0 !important;
}
.description-tab ul li a {
    text-decoration: none;
    font-size: 14px !important;
    font-weight: 400 !important;
    color: #272727 !important;
        padding: 0 !important;
	font-weight:bold !important;
}
ul#pills-tab {
    margin-bottom: 0 !important;
}
.woocommerce.single-product div.product .woocommerce-tabs .panel {
    padding: 0 !important;
}
.woocommerce.single-product div.product .woocommerce-tabs ul.tabs:before{
	display: none;
}
li.nav-link.active {
    background: rgba(194,70,144,1)!important;
    color: #fff !important;
}
li.nav-link.active a{
	color: #fff !important;
}
.product-price label span {
    border: 0;
    margin: 0;
    padding: 0;
}
.product-price label span {
    margin: 0;
    font-size: 24px;
    font-weight: 700;
    line-height: 40px;
    color: #272727;
    display: inline-block;
    vertical-align: middle;
}
header#header {
    display: none;
}
.signup {
    display: none;
}
div#main-footer {
    display: none;
}
/*footer.footer,header.header,section.announcement-bar.w-100 {
    width: 100vw !important;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
}*/
.product-price span span {
    padding: 0;
    border: 0;
    margin: 0;
}
.woocommerce div.product .woocommerce-product-gallery .product-icons-wrapper {
    position: relative;
}


.beforetool {
    display: flex;
    align-items: center;
    position: relative;
}
.beforetool p {
    margin-left: 5px;
}
.tooltipsku {
  
  display: inline-block;
}

.tooltipsku .tooltiptext {
  visibility: hidden;
  width: 100%;
  text-align: center;
  padding: 5px;
  background-color: #fff;
  background-position: 50% 0;
  border: 1px solid #ccc;
  border-radius: 5px;
  color: #272727;

  /* Position the tooltip */
  position: absolute;
  z-index: 99999;
  font-size: 12px;
}

.tooltipsku:hover .tooltiptext {
  visibility: visible;
}
</style>




<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	//do_action( 'woocommerce_before_single_product_summary' );
	?>

	<!-- <div class="summary entry-summary"> -->
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		//do_action( 'woocommerce_single_product_summary' );
		?>
	<!-- </div> -->

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	//do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>