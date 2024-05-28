<?php
/**
 * Template part for displaying posts
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
 $banner_img = $fields['image_for_single_post_banner'] ?? null;
 
 $categories = $args['categories'] ?? null;
 $taxonomies = $args['taxonomies'] ?? null;
 $slug_front = '/beers/';
 ?>
 
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header beer-banner position-relative bg-blue grid-x grid-padding-x align-bottom tablet-flex-dir-row-reverse">
		<?php if( !empty( $banner_img ) ) {
			$imgID = $banner_img['ID'];
			$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
			$img = wp_get_attachment_image( $imgID, 'beer-post-banner', false, [ "class" => "", "alt"=>$img_alt] );
			echo '<div class="img-wrap">';
			echo $img;
			echo '</div>';
		}?>
	</header>
	<div class="entry-content">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="inner cell small-12 position-relative">
					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'trailhead' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						)
					);
			
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'trailhead' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer grid-x">
		<?php
		if( $categories || $taxonomies) {
			echo '<ul class="tax-menu no-bullet grid-x grid-padding-x font-header">';
			echo '<li class="tax-label cell shrink color-purple">See All</li>';
			
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
							echo '<a class="color-yellow" href="' . $slug_front . '' . $term->slug . '">';
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
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
