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

			get_template_part( 'template-parts/content', get_post_type() );?>
			
			<div class="grid-container">
				<div class="grid-x grid-padding-x align-center">
					<div class="inner cell small-12 medium-10 tablet-4 position-relative font-header uppercase">
						<?php
						the_post_navigation(
							array(
								'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="9.609" height="15.561" viewBox="0 0 9.609 15.561"><path id="prev" d="M16.371,6,18.2,7.828,12.26,13.781,18.2,19.733l-1.828,1.828L8.59,13.781Z" transform="translate(-8.59 -6)"/></svg><span class="nav-subtitle"><b>' . esc_html__( 'Prev', 'trailhead' ) . '</b></span>',
								'next_text' => '<span class="nav-subtitle"><b>' . esc_html__( 'Next', 'trailhead' ) . '</b></span><svg xmlns="http://www.w3.org/2000/svg" width="9.609" height="15.561" viewBox="0 0 9.609 15.561"><path id="prev" d="M10.419,6,8.59,7.828l5.939,5.952L8.59,19.733l1.829,1.828L18.2,13.781Z" transform="translate(-8.59 -6)"/></svg>',
							)
						);?>
					</div>
				</div>
			</div>

			<?php get_template_part('template-parts/section', 'post-footer-nav');?>
			
		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();