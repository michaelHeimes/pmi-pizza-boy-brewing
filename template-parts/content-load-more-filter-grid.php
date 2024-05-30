<?php
$queried_object = get_queried_object() ?? null;

// This template is used for all JS load more and filtering
$style = $args['style'] ?? null;
$index_page = $args['index_page'] ?? null;

$style_terms = get_terms( array(
	'taxonomy'   => 'style',
	'hide_empty' => true,
) );

$primary_cat_terms = $style_terms;
$primary_cat_front = '/our-beers/';
$primary_all = $primary_cat_front;
$index_page = $primary_cat_front;
$active_term = $style;


//Faceting functionality
$abv_range_terms = get_terms( array(
	'taxonomy'   => 'abv-range',
	'hide_empty' => true,
) );

$availability_terms = get_terms( array(
	'taxonomy'   => 'availability',
	'hide_empty' => true,
) );

// Initialize an array to store term objects
$abv_range_terms_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
$post_terms = wp_get_post_terms($post->ID, 'abv-range'); 
// Merge the term arrays
$abv_range_terms_check = array_merge($abv_range_terms_check, $post_terms);
}

// Initialize an array to store term objects
$availability_terms_check = array();
// Loop through each post to retrieve associated terms
foreach ($posts as $post) {
$post_terms = wp_get_post_terms($post->ID, 'availability'); // Replace 'your_taxonomy' with your actual taxonomy name
// Merge the term arrays
$availability_terms_check = array_merge($availability_terms_check, $post_terms);
}

?>

<section class="isotope-filter-loadmore loading overflow-hidden" data-postsper="12>">
	<header class="entry-header beer-banner position-relative bg-blue">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="cell small-12">
	
					<div id="options" class="tax-menu-wrap uppercase">
						<div class="styles tax-menu grid-x grid-padding-x align-center">
							<?php if($primary_cat_terms && !is_wp_error($primary_cat_terms)) : foreach($primary_cat_terms as $term): ?>
								<div class="cell shrink top-level">
									<a class="button filter-btn <?php if( !empty($active_term) && $term->slug == $active_term->slug) { echo ' active'; };?>" href="<?=esc_url($primary_cat_front);?><?=esc_attr( $term->slug );?>/">
										<?=esc_html( $term->name );?>
									</a>
								</div>
								<?php endforeach;?>
								<div class="cell shrink top-level">
									<a class="button filter-btn all active" href="<?=esc_url($index_page);?>">
										All
									</a>
								</div>
							<?php endif;?>
						</div>
						<div class="filter-group">
							<div class="option-set other-terms tax-menu grid-x grid-padding-x align-center" data-group="taxonomy-terms">
								<?php if($abv_range_terms && !is_wp_error($abv_range_terms)) : foreach($abv_range_terms as $term):
										if( in_array($term, $abv_range_terms_check) ):
									?>
									<div class="cell shrink" data-group="abv-ranges">
										<div class="input-wrap  color-white">
											<?='<input name="abv-range" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label class="button" for="' . $term->slug . '"/>' . $term->name . '</label>';?>
										</div>
									</div>
								<?php endif; endforeach; endif;?>
								
								<?php if($availability_terms && !is_wp_error($availability_terms)): foreach($availability_terms as $term):
										if( in_array($term, $availability_terms_check) ):
									?>
									<div class="cell shrink" data-group="availabilities">
										<div class="input-wrap color-white">
											<?='<input name="availability" type="checkbox" id="' . $term->slug . '" value=".' . $term->slug . '" data-taxonomy-terms="' . $term->slug . '"/><label class="button" for="' . $term->slug . '"/>' . $term->name . '</label>';?>
										</div>
									</div>
								<?php endif; endforeach; endif;?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<div class="filter-grid grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-3">
					<?php foreach( $posts as $post ){
						get_template_part('template-parts/loop', 'beer',
							array(
								'card-classes' => 'hidden',
							),
						);
					}?>
				</div>		
				<div class="text-center load-more-wrap">
					<button class="button" id="load-more">Load More</button>
				</div>
			</div>		
		</div>	
	</div>
</section>
