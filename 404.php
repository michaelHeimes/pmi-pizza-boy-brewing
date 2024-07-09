<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package trailhead
 */

get_header();
$error_copy_404 = get_field('error_copy_404', 'option') ?? null;
?>
	<div class="content entry-content has-top-repeating-bg">
		<div class="grid-container position-relative">
			<div class="inner-content grid-x grid-padding-x">
				<div class="cell small-12">
					<main id="primary" class="site-main">
						<article class="content-not-found">
							<?php if( !empty($error_copy_404) ):?>
								<?=$error_copy_404;?>
							<?php else:?>
								<header class="article-header">
									<h1>404</h1>
								</header> <!-- end article header -->
							
								<section class="entry-content">
									<p>The page you're looking for doesn't exist. Please use the navigation at the top of the page or <a href="<?php echo home_url(); ?>">return to the home page.</a></p>
								</section> <!-- end article section -->
							<?php endif;?>
						
						</article> <!-- end article -->
					</main><!-- #main -->
				</div>
			</div>
		</div>
	</div><!-- end content -->

<?php
get_footer();
