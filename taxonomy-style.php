<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

 get_header();
 
 $queried_object = get_queried_object(); 
 
 $args = array(  
		'post_type' => 'beer-cpt',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'meta_key' => 'packaged_date',
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'tax_query' => array(
		array(
			'taxonomy' => 'style',
			'field'    => 'slug',
			'terms'    =>  $queried_object->slug,
		),
	),
 );
 $posts = get_posts($args);	 
 ?>

<main id="primary" class="site-main">


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
	
</main><!-- #main -->

<?php
get_footer();
