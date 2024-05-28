<?php
/**
 * Template part for displaying posts in an archive grid
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card cell'); ?>>
	<a class="color-black" href="<?=esc_url( get_permalink() );?>" rel="bookmark">
		<div class="thumb-wrap">
			<?php the_post_thumbnail('beer-archive'); ?>
		</div>
		
		<div>
			<header class="entry-header">
				<?php
					the_title( '<h2 class="entry-title color-black">', '</h2>' );
				?>
				<?php
				if ( has_excerpt() ) {
					// If there is a custom excerpt, display it
					the_excerpt();
				} else {
					// If there is no custom excerpt, create one from the first 20 characters of the content
					$content = get_the_content();
					$trimmed_content = mb_substr( $content, 0, 20 ) . '...'; // Get the first 20 characters and append ellipsis
					echo '<p>' . esc_html( $trimmed_content ) . '</p>';
				}
				?>
			</header><!-- .entry-header -->
		</div>
	
		<footer class="entry-footer">
			<div class="button chev-btn grid-x align-center">
				<span>View Beer</span>
				<svg xmlns="http://www.w3.org/2000/svg" width="12.35" height="20"><path d="M2.35 0 0 2.35 7.633 10 0 17.65 2.35 20l10-10Z" fill="#fff"/></svg>
			</div>
		</footer><!-- .entry-footer -->
	</a>
</article><!-- #post-<?php the_ID(); ?> -->
