<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
 
$queried_object = get_queried_object() ?? null;
 
$title = '';
 
if( get_field('blog_banner_title', $queried_object) ) {
	$title = get_field('blog_banner_title', $queried_object);
} else {
	$title = get_the_archive_title();	
} 
?>

<main id="primary" class="site-main">
	<?php get_template_part('template-parts/section', 'blog-banner',
		array (
			'title' => $title,	
			'featured_image_ID' => get_field('archive_banner_image', $queried_object)['id'],
		),
	);?>
	<div class="blog-primary position-relative has-top-repeating-bg">
		<div class="grid-container">
			<div class="grid-x grid-padding-x align-center">
				<div class="cell small-12">
					<?php if( is_archive() && !empty( $queried_object->category_description ) ):?>
						<div class="grid-intro entry-content">
							<?=$queried_object->category_description;?>
						</div>
					<?php endif;?>
					<?php
					if ( have_posts() ) :?>
						 
						<?php
						echo '<div class="posts-grid grid-x grid-padding-x small-up-1 medium-up-2 tablet-up-3 card-grid">';
 
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
				 
								 /*
								  * Include the Post-Type-specific template for the content.
								  * If you want to override this in a child theme, then include a file
								  * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								  */
									get_template_part( 'template-parts/loop', get_post_type() );
							endwhile;
						 
						echo '</div>';
						 
						echo '<div class="grid-x grid-padding-x align-center">';
							echo '<div class="inner cell small-12 medium-10 tablet-4 position-relative font-header uppercase">';
								trailhead_page_navi();
							echo '</div>';
						echo '</div>';
			 
					else :
			 
						get_template_part( 'template-parts/content', 'none' );
			 
					endif;
					?>
					 
					<?php get_template_part('template-parts/section', 'post-footer-nav');?>
					 
				</div>
			</div>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
