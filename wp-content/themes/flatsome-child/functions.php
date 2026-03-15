<?php
// Add custom Theme Functions here
// off xml
add_filter('xmlrpc_enabled', '__return_false');
//clasic widget
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );
//include 
add_filter('flatsome_lightbox_close_btn_inside', '__return_true');
//custom style
function dn_scripts() {
    wp_enqueue_style('dn-global', get_stylesheet_directory_uri() . '/assets/css/global.css?'.time() );
    wp_enqueue_script('dn-custom', get_stylesheet_directory_uri() . '/assets/js/custom.js?'.time(), array('jquery'), false, true);
}
add_action( 'wp_enqueue_scripts', 'dn_scripts' );
//lang
add_filter( 'login_display_language_dropdown', '__return_false' );
// top
function footertop(){
	?><a href="#top" class="scroll-top">
	<div class="progress-container">
    <svg class="progress-ring" width="48" height="48">
        <circle class="progress-ring__circle" cx="24" cy="24" r="22" stroke-width="3"></circle>
    </svg>
  </div>
	</a>
	<?php
}
add_action( 'wp_footer', 'footertop', 99 );
//UAH
add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
function add_my_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
         case 'UAH': $currency_symbol = 'грн'; break;
     }
     return $currency_symbol;
}
//images support
add_action( 'after_setup_theme', 'true_add_image_size' ); 
function true_add_image_size() {
    add_image_size( 'blog-img', 1220, 250, true );
		add_image_size( 'product-img', 300, 300, true );
}
//polylang
if( ! function_exists( 'pll_e' ) ) {
  function pll_e( $string ) {
    echo $string;
  }
}
//off map
add_filter( 'wp_sitemaps_enabled', '__return_false' );
//url widget
function alter_login_headerurl() {
	return '/'; 
}
add_action('login_headerurl','alter_login_headerurl');
//login page
function my_login() { ?>
<style type="text/css">
	.login form, .login #login_error, .login .message, .login .success {
	border-radius: 8px;
	font-family: inherit;
	}
	#loginform input[type=password], 
	#loginform input[type=text] {
  font-size: 12px;
	border-radius: 8px!important;
	}
	#loginform #wp-submit {
  background: #333;
	color: #fff!important;
  border: none;
  width: 100%;
  margin-top: 10px;
  border-radius: 8px;
  height: 45px;
	color: #000;
	}
	#nav, #backtoblog, .privacy-policy-page-link {
	font-family: inherit;
	}
  body.login div#login h1 a {
	background-image: url(/wp-content/uploads/loho-5.svg) !important;
	background-size: contain;
	width: 150px;}
	body {
	background-image: url(/wp-content/uploads/sovremennyi-bezuprecnyi-fitnes-centr-interio-generative-ai-scaled.jpg)!important;
	background-repeat: no-repeat!important;
	background-position: center!important;
	background-size: cover!important;
	background-blend-mode: overlay!important;
	background-color: rgb(0 0 0 / 70%) !important;
  }
	.login #backtoblog,
	.login #nav {
  text-align: center;
  }
  .login #backtoblog a, .login #nav a {
	padding: 2px;
	border-radius: 0px;
	}
	a.privacy-policy-link, #nav a, #backtoblog a {
	color: #000!important;	
	}
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login' );
//last products swiper
function last_products_swiper() {

  $args = [
    'post_type'      => 'product',
    'posts_per_page' => 8,
    'post_status'    => 'publish'
  ];

  $query = new WP_Query($args);

  ob_start();
  ?>
  <div class="swiper products-new products-swiper">
    <div class="swiper-wrapper">
      <?php while ($query->have_posts()) : $query->the_post();
        global $product;
        $categories = wc_get_product_category_list(get_the_ID());
      ?>
        <div class="swiper-slide product-card product-small box products-slider has-hover box-normal box-text-bottom">
          <a href="<?php the_permalink(); ?>" class="product-image">
            <?php echo $product->get_image('product-img'); ?>
          </a>
          <div class="product-info">
            <div class="product-category category uppercase is-smaller no-text-overflow product-cat op-7">
              <?php echo strip_tags($categories); ?>
            </div>
            <p class="product-title name product-title woocommerce-loop-product__title"><?php the_title(); ?></p>
            <div class="product-price price-wrapper">
              <?php echo $product->get_price_html(); ?>
            </div>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  <?php
  return ob_get_clean();
}
add_shortcode('last_products_swiper', 'last_products_swiper');
//product attributes table
add_shortcode( 'product_attributes_table', 'product_attributes_table_shortcode' );
function product_attributes_table_shortcode() {

    if ( ! is_product() ) return '';

    global $product;

    if ( ! $product || ! $product->has_attributes() ) return '';

    ob_start();

    echo '<table class="woocommerce-product-attributes shop_attributes">';

    foreach ( $product->get_attributes() as $attribute ) {

        if ( ! $attribute->get_visible() ) continue;

        $label = wc_attribute_label( $attribute->get_name() );
        $values = [];

        if ( $attribute->is_taxonomy() ) {
            $terms = wc_get_product_terms(
                $product->get_id(),
                $attribute->get_name(),
                [ 'fields' => 'names' ]
            );
            $values = $terms;
        } else {
            $values = $attribute->get_options();
        }

        if ( empty( $values ) ) continue;

        echo '<tr>';
        echo '<th>' . esc_html( $label ) . '</th>';
        echo '<td>' . esc_html( implode( ', ', $values ) ) . '</td>';
        echo '</tr>';
    }

    echo '</table>';

    return ob_get_clean();
}
//brand shortcode
add_shortcode( 'wc_brand', function () {

    global $product;

    if ( ! $product ) return '';

    $terms = get_the_terms( $product->get_id(), 'product_brand' );

    if ( empty( $terms ) || is_wp_error( $terms ) ) return '';

    $brand = $terms[0]; 

    $link = get_term_link( $brand );
    if ( is_wp_error( $link ) ) return '';

    $thumbnail_id = get_term_meta( $brand->term_id, 'thumbnail_id', true );
    $image = $thumbnail_id ? wp_get_attachment_image( $thumbnail_id, 'medium' ) : '';

    ob_start();

    echo '<div class="wc-product-brand">';
    echo '<a href="' . esc_url( $link ) . '" title="' . esc_attr( $brand->name ) . '">';

    if ( $image ) {
        echo $image;
    } else {
        echo esc_html( $brand->name );
    }

    echo '</a>';
    echo '</div>';

    return ob_get_clean();
});
//script more
function add_js_functions(){
?>
<script>
    jQuery(document).ready(function($) {
      $(".toggleBtn span").click(function() {
        $(".seo-text").toggleClass('active');  
        if ($(".seo-text").hasClass('active')) {
          $(this).text("<?php pll_e('Згорнути'); ?>");
          $('.toggleBtn span').addClass('rotate');
        } else {
          $(this).text("<?php pll_e('Розгорнути'); ?>");
          $('.toggleBtn span').removeClass('rotate');
        }
      });
    });
</script>
<?php
}
add_action('wp_head','add_js_functions');


add_shortcode( 'product_attributes_table_custom', function () {

    if ( ! is_product() ) {
        return '';
    }

    global $product;

    if ( ! $product || ! $product->has_attributes() ) {
        return '';
    }

    $attributes = array_filter(
        $product->get_attributes(),
        function ( $attribute ) {
            return $attribute->get_visible();
        }
    );

    if ( empty( $attributes ) ) {
        return '';
    }

    // 👉 берём ПОСЛЕДНИЕ 5 атрибутов
    $attributes = array_slice( $attributes, 0, 5, true );

    ob_start();

    echo '<div class="custom-product-attributes">';
    echo '<table class="custom-attributes-table">';

    foreach ( $attributes as $attribute ) {

        $label  = wc_attribute_label( $attribute->get_name() );
        $values = [];

        if ( $attribute->is_taxonomy() ) {
            $values = wc_get_product_terms(
                $product->get_id(),
                $attribute->get_name(),
                [ 'fields' => 'names' ]
            );
        } else {
            $values = $attribute->get_options();
        }

        if ( empty( $values ) ) {
            continue;
        }

        echo '<tr class="custom-attributes-row">';
        echo '<th class="custom-attributes-label">' . esc_html( $label ) . '</th>';
        echo '<td class="custom-attributes-value">' . esc_html( implode( ', ', $values ) ) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';

    return ob_get_clean();
});

// category products swiper 
function category_products_swiper() {

  if ( ! is_product() ) {
    return '';
  }

  global $product;

  if ( ! $product ) {
    return '';
  }

  $terms = wp_get_post_terms(
    $product->get_id(),
    'product_cat',
    [ 'fields' => 'ids' ]
  );

  if ( empty( $terms ) || is_wp_error( $terms ) ) {
    return '';
  }

  $args = [
    'post_type'      => 'product',
    'posts_per_page' => 10, 
    'post_status'    => 'publish',
    'post__not_in'   => [ $product->get_id() ],
    'tax_query'      => [
      [
        'taxonomy' => 'product_cat',
        'field'    => 'term_id',
        'terms'    => $terms,
      ],
    ],
  ];

  $query = new WP_Query( $args );

  if ( ! $query->have_posts() ) {
    return '';
  }

  ob_start();
  ?>
  <div class="swiper products-new category-swiper">
    <div class="swiper-wrapper">
      <?php while ( $query->have_posts() ) : $query->the_post();
        global $product;
        $categories = wc_get_product_category_list( get_the_ID() );
      ?>
        <div class="swiper-slide product-card product-small box products-slider has-hover box-normal box-text-bottom">
          <a href="<?php the_permalink(); ?>" class="product-image">
            <?php echo $product->get_image('product-img'); ?>
          </a>
          <div class="product-info">
            <div class="product-category category uppercase is-smaller no-text-overflow product-cat op-7">
              <?php echo strip_tags( $categories ); ?>
            </div>
            <p class="product-title name product-title woocommerce-loop-product__title">
              <?php the_title(); ?>
            </p>
            <div class="product-price price-wrapper">
              <?php echo $product->get_price_html(); ?>
            </div>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  <?php
  return ob_get_clean();
}
add_shortcode( 'category_products_swiper', 'category_products_swiper' );
