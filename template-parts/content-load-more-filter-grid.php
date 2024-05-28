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
?>

<section class="isotope-filter-loadmore loading overflow-hidden" data-postsper="<?=esc_attr( $posts_per_load );?>">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<div class="cell small-12">

				<div id="options" class="tax-menu-wrap">
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
						<div class="option-set other-terms tax-menu grid-x grid-padding-x" data-group="taxonomy-terms">
							<?php 
								// get_template_part('template-parts/part', 'filter-btns',
								// 	array (
								// 		'style_terms' => $style_terms,
								// 	),
								// );
							?>
						</div>
					</div>
				</div>
			</div>
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
			</div>			
		<div class="text-center load-more-wrap">
			<button class="button" id="load-more">Load More</button>
		</div>
		</div>
	</div>
</section>
