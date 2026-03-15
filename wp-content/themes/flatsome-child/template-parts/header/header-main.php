<?php
/**
 * Header main.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.20.0
 */

?>
<div id="masthead" class="header-main <?php header_inner_class('main'); ?>">
      <div class="header-inner flex-row container <?php flatsome_logo_position(); ?>" role="navigation">
				  <div class="left-col">
						<!-- Logo -->
						<div id="logo" class="flex-col logo">
							<?php get_template_part('template-parts/header/partials/element','logo'); ?>
						</div>
						<!-- Mobile Left Elements -->
						<div class="flex-col show-for-medium flex-left">
							<ul class="mobile-nav nav nav-left <?php flatsome_nav_classes('main-mobile'); ?>">
								<?php flatsome_header_elements('header_mobile_elements_left','mobile'); ?>
							</ul>
						</div>
					</div>          
					<div class="right-col">
						<!-- Left Elements -->
						<div class="flex-col hide-for-medium flex-center
							<?php if(get_theme_mod('logo_position', 'left') == 'left') echo 'flex-grow'; ?>">
							<ul class="header-nav header-nav-main nav nav-left <?php flatsome_nav_classes('main'); ?>" >
								<?php flatsome_header_elements('header_elements_left'); ?>
							</ul>
						</div>
						<!-- Right Elements -->
						<div class="flex-col hide-for-medium flex-right">
							<ul class="header-nav header-nav-main nav nav-right <?php flatsome_nav_classes('main'); ?>">
								<?php flatsome_header_elements('header_elements_right'); ?>
							</ul>
						</div>
						<!-- Mobile Right Elements -->
						<div class="flex-col show-for-medium flex-right">
							<ul class="mobile-nav nav nav-right <?php flatsome_nav_classes('main-mobile'); ?>">
								<?php flatsome_header_elements('header_mobile_elements_right','mobile'); ?>
							</ul>
						</div>
					</div> 
      </div>   

      <?php if(get_theme_mod('header_divider', 1)) { ?>
      <div class="container"><div class="top-divider full-width"></div></div>
      <?php }?>
			<div class="search-bottom">
				<div class="section align-center">
					<div id="search-lightbox" class="text-center">
						<?php echo do_shortcode('[search size="large" style="'.get_theme_mod('header_search_form_style').'"]'); ?>
					</div>
				</div>
				<div class="section">
					<div class="row align-center">
						<div class="col large-8">
							<p class="text-center">Чим ми можемо вам допомогти?</p>
							<?php
							wp_nav_menu( array(
								'menu' => 'Cat menu', 
								'menu_class' => 'category-menu flex',
								'container' => false
							) );
							?>
						</div>
					</div>
  			</div>
			</div>
			<div class="menu-block">
				<div class="section align-center">
					<div class="row align-center">		
						<?php 
						$terms = get_terms( array(
								'taxonomy'   => 'product_cat',
								'hide_empty' => true,
								'include'    => array(31, 33, 27, 18, 37, 39, 29),
						) );

						if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
								foreach ( $terms as $term ) {

										// ACF image for category
										$cat_image = get_field( 'cat-image', 'product_cat_' . $term->term_id );

										if ( $cat_image ) {
												$img_url = is_array( $cat_image ) ? $cat_image['url'] : $cat_image;
										} else {
												$img_url = '/wp-content/uploads/sport-1.png';
										}

										echo '<div class="col large-3 flex">';

										echo '<div class="img-cat">
														<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $term->name ) . '">
													</div>';

										echo '<div class="col large-12 product-category-block">';
										echo '<div class="title">' . esc_html( $term->name ) . '</div>';

										$subcats = get_terms( array(
												'taxonomy'   => 'product_cat',
												'hide_empty' => false,
												'parent'     => $term->term_id,
												'number'     => 5,
										) );

										if ( ! empty( $subcats ) && ! is_wp_error( $subcats ) ) {
												echo '<ul class="subcategory-list">';
												foreach ( $subcats as $subcat ) {
														echo '<li class="subcategory-item">';
														echo '- <a href="' . esc_url( get_term_link( $subcat ) ) . '">';
														echo '<span class="subcategory-title">' . esc_html( $subcat->name ) . '</span>';
														echo '</a>';
														echo '</li>';
												}
												echo '</ul>';
										}

										echo '<p class="view-more"><a href="' . esc_url( get_term_link( $term ) ) . '">всі категорії →</a></p>';
										echo '</div></div>';
								}
						}
						?>
						<div class="col large-3">
							<?php echo do_shortcode('[block id="sale-block"]'); ?>
						</div>
				  </div>
		    </div>
				<?php echo do_shortcode('[block id="menu-footer"]'); ?>
      </div>
