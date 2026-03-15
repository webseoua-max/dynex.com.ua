<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see              https://docs.woocommerce.com/document/template-structure/
 * @package          WooCommerce\Templates
 * @version          4.7.0
 * @flatsome-version 3.16.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cat_style = get_theme_mod( 'cat_style', 'badge' );
$color     = '';
$text_pos  = '';

if ( $cat_style == 'overlay' || $cat_style == 'shade' ) {
	$color = 'dark';
}
if ( $cat_style == 'overlay' ) {
	$text_pos = 'box-text-middle text-shadow-5';
}
if ( $cat_style == 'badge' ) {
	$text_pos .= ' hover-dark';
}

$classes = array( 'product-category', 'col' );
?>
<div <?php wc_product_cat_class( $classes, $category ); ?>>
	<div class="col-inner">
		<?php
		/**
		 * The woocommerce_before_subcategory hook.
		 *
		 * @hooked woocommerce_template_loop_category_link_open - 10
		 */
		do_action( 'woocommerce_before_subcategory', $category );
		?>

<div class="box-<?php echo esc_attr( $cat_style ); ?> <?php echo esc_attr( $text_pos ); ?> <?php echo esc_attr( $color ); ?>">
	
	<?php
	$cat_image = get_field( 'cat-image', 'product_cat_' . $category->term_id );

	if ( $cat_image ) {
		$img_url = is_array( $cat_image ) ? $cat_image['url'] : $cat_image;
	} else {
		$img_url = '/wp-content/uploads/sport-1.png';
	}
	?>

	<div class="cat-image">
		<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $category->name ); ?>">
	</div>

	<div class="cat-text text-center">
		<div class="box-text-inner">
			<h5 class="uppercase header-title">
				<?php echo esc_html( $category->name ); ?>
			</h5>

			<?php
			$subcategories = get_terms( array(
				'taxonomy'   => 'product_cat',
				'parent'     => $category->term_id,
				'hide_empty' => false,
				'number'     => 8,
			) );

			if ( ! empty( $subcategories ) && ! is_wp_error( $subcategories ) ) : ?>
				
				<ul class="is-small subcategory-links">
					<?php foreach ( $subcategories as $subcat ) : ?>
						<li>
							<a href="<?php echo esc_url( get_term_link( $subcat ) ); ?>">
								-  <?php echo esc_html( $subcat->name ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>

			<?php endif; ?>		

			<?php do_action( 'woocommerce_after_subcategory_title', $category ); ?>
		</div>
	</div>
	
</div>


		<?php
		/**
		 * The woocommerce_after_subcategory hook.
		 *
		 * @hooked woocommerce_template_loop_category_link_close - 10
		 */
		do_action( 'woocommerce_after_subcategory', $category );
		?>
	</div>
</div>


