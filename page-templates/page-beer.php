<?php
/**
 * Template name: Beer Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$fields = get_fields();

$args = array(  
	'post_type' => 'beer-cpt',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'meta_key' => 'brew_date',
	'orderby' => 'meta_value',
	'order' => 'ASC',
);
$posts = get_posts($args);	 
?>
<div class="content">
	<div class="inner-content">
	
		<main id="primary" class="site-main">
	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
				<?php get_template_part('template-parts/content', 'load-more-filter-grid', 
					array(
						'posts' => $posts,
						'posts-per-load' => 12,
					),
				);?>
				
			</article>
		</main>
	
	</div>
</div>

<?php
get_footer();