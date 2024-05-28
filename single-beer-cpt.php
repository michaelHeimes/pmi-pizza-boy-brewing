<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package trailhead
 */

get_header();

?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			
			$post_id = get_the_ID();
			$term_slugs = [];
			$taxonomies = '';
			$combined_terms = '';
			
			$categories = array('style');
			$taxonomies = array('availability', 'abv-range') ?? null;
			
			// Loop through each taxonomy
			if($taxonomies) {
				foreach ($taxonomies as $taxonomy) {
					 // Get the terms assigned to the post for the current taxonomy
					 $terms = get_the_terms($post_id, $taxonomy);
				
					// Check if there are any terms
					if ($terms && !is_wp_error($terms)) {
						// Loop through each term and add its slug to the array
						foreach ($terms as $term) {
							$term_slugs[] = $term->slug;
						}
					}
				}
			}
			
			// Combine term slugs into a single string separated by spaces
			if (!empty($term_slugs)) {
				$combined_terms = implode(' ', $term_slugs);
			}

			get_template_part( 'template-parts/content', get_post_type(),
				array(
					'post_id' => $post_id,	
					'categories' => $categories,
					'taxonomies' => $taxonomies,
					'combined_terms' => $combined_terms,
				),	
			);?>
			
		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();