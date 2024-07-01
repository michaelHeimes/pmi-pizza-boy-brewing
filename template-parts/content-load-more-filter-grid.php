<?php
$post_content = '';

if( is_archive() ) {
	$queried_object = get_queried_object() ?? null;
	if( !empty($queried_object->description) ) {
		$post_content = $queried_object->description;
	} else {
		$post_content = $queried_object->name;
	}
} else {
	$post_content = get_post_field('post_content', get_the_ID());
}

$queried_object = get_queried_object() ?? null;

// This template is used for all JS load more and filtering
$style = $args['style'] ?? null;
$index_page = $args['index_page'] ?? null;

$style_terms = get_terms( array(
	'taxonomy'   => 'style',
	'hide_empty' => true,
) );

$primary_cat_terms = $style_terms;
$primary_cat_front = '/brewery/our-beers/';
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

<section class="isotope-filter-loadmore loading overflow-hidden" data-postsper="12">
	<header class="entry-header beer-banner position-relative bg-blue">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="cell small-12 position-relative">
					<h1 class="color-white text-center"><?=wp_kses_post($post_content);?></h1>
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
	<div class="grid-wrap grid-container position-relative">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12">
				<div class="grid-container">
					<div class="dropdown-wrap grid-x align-right">
						<button class="button grid-x grid-padding-x" type="button" data-toggle="sort-dropdown">
							<div class="cell auto uppercase">Sort By</div>
							<div class="cell shrink">
								<svg xmlns="http://www.w3.org/2000/svg" width="9.18" height="18"><path d="M4.59 2.83 7.76 6l1.41-1.41L4.59 0 0 4.59 1.42 6Zm0 12.34L1.42 12 .01 13.41 4.59 18l4.59-4.59L7.76 12Z" fill="#f9ae4c"/></svg>
							</div>
						</button>
						<div class="dropdown-pane sort-dropdown small text-center" id="sort-dropdown" data-dropdown data-auto-focus="true" data-close-on-click="true" data-trap-focus="true" data-position="bottom" data-alignment="center">
							<div class="btn-wrap">
								<button id="sort-alphabetically" type="button" class="no-style font-heading uppercase color-yellow" data-sort-direction="asc" data-sort-value="beername">
									Sort By Alphabetical
								</button>
							</div>
							<div class="btn-wrap">
								<button id="sort-brew-date" type="button" class="active no-style font-heading uppercase color-yellow" data-sort-direction="asc" data-sort-value="brewdate">
									Sort By Packaged Date
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="filter-grid grid-x grid-padding-x card-grid small-up-1 medium-up-2 tablet-up-3">
					<?php foreach( $posts as $post ){
						get_template_part('template-parts/loop', 'beer',
							array(
								'card-classes' => 'hidden',
							),
						);
					}?>
				</div>		
				<div class="text-center load-more-wrap">
					<button class="button" id="load-more">More Beer</button>
				</div>
			</div>		
		</div>	
	</div>
</section>
