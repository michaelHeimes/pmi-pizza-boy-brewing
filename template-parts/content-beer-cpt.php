<?php
/**
 * Template part for displaying beer posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */
 $fields = get_fields();
 $post_id = $args['post_id'] ?? null;
 $home_url = get_home_url();

 // banner
 $title = get_the_title();
 $abv = $fields['abv'] ?? null;
 $brew_date = get_field('brew_date') ?? null;
 $banner_img = $fields['image_for_single_post_banner'] ?? null;
 
 $categories = $args['categories'] ?? null;
 $taxonomies = $args['taxonomies'] ?? null;
 $slug_front = 'brewery/our-beers/';
 ?>
 
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header beer-banner position-relative bg-blue">
		<div class="grid-container position-relative">
			<div class="grid-x grid-padding-x medium-flex-dir-row-reverse color-white">
				<?php if( !empty( $banner_img ) ) {
					$imgID = $banner_img['ID'];
					$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
					$img = wp_get_attachment_image( $imgID, 'beer-post-banner', false, [ "class" => "", "alt"=>$img_alt] );
					echo '<div class="cell small-12 medium-5 img-wrap">';
					echo $img;
					echo '</div>';
				}?>
				<div class="text-wrap cell small-12 medium-7 grid-x flex-dir-column align-justify color-white">
					<div>
						<h1 class="color-white"><?=esc_html($title);?></h1>
						<div class="color-pale-blue">
							<?php the_content();?>
						</div>
						<?php if( !empty($abv) || $brew_date ):?>
							<div class="abv-date">
								<?php if( !empty($abv ) ):?>
								<div class="h4 color-white font-body weight-semibold">
									ABV: <?=esc_html( $abv  );?>%
								</div>
								<?php endif;?>
								<?php if( !empty($brew_date) ):
									$date = DateTime::createFromFormat( 'Ymd', $brew_date );
								?>
									<div class="h4 color-white font-body weight-semibold">
										Brew Date: <?=esc_html( $date->format( 'm/d/Y' ) );?>
									</div>	
								<?php endif;?>
							</div>
						<?php endif;?>
					</div>
					
					<?php
					if( $categories || $taxonomies) {
						echo '<ul class="tax-menu no-bullet grid-x grid-padding-x font-heading">';
						echo '<li class="tax-label cell shrink color-pale-blue">See All</li>';
						
						// Loop through each category
						if($categories) {
							foreach ($categories as $category) {
								// Get the terms assigned to the post for the current taxonomy
								$terms = get_the_terms($post_id, $category);
								// Check if there are any terms
								if ($terms && !is_wp_error($terms)) {
									// Loop through each term and add its slug to the array
									foreach ($terms as $term) {
										echo '<li class="cell shrink">';
										echo '<a class="color-yellow" href="' .  $home_url . '/' . $slug_front . '' . $term->slug . '/">';
										echo $term->name;
										echo '</a>';
										echo '</li>';
									}
								}
							}
						}
						
						// Loop through each taxonomy
						if($taxonomies) {
							foreach ($taxonomies as $taxonomy) {
								// Get the terms assigned to the post for the current taxonomy
								$terms = get_the_terms($post_id, $taxonomy);
							
								// Check if there are any terms
								if ($terms && !is_wp_error($terms)) {
									// Loop through each term and add its slug to the array
									foreach ($terms as $term) {
										echo '<li class="cell shrink">';
										echo '<a class="color-yellow" href="' . $home_url . '/' . $slug_front . '?' . $taxonomy .  '=.' . $term->slug . '">';
										echo $term->name;
										echo '</a>';
										echo '</li>';
									}
								}
							}
						}
						echo '</ul>';
					}
					?>
					
				</div>
			</div>
		</div>
	</header>

	<footer class="entry-footer grid-x">

	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
