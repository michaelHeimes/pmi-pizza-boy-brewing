<?php
/**
 * Template part for displaying posts in an archive grid
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */
 $abv = get_field('abv') ?? null;
 $packaged_date = get_field('packaged_date') ?? null;
 
 $post_id = $post->ID;
 $term_slugs = [];
 $taxonomies = array('style', 'abv-range', 'availability');

 // Loop through each taxonomy
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
 
 // Combine term slugs into a single string separated by spaces
 if (!empty($term_slugs)) {
	 $combined_terms = implode(' ', $term_slugs);
 }
 
 $article_classes = 'beer-card hidden cell grid-x' . ' ' . $combined_terms;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($article_classes); ?> data-terms="<?= esc_attr($combined_terms); ?>" data-brew-date="<?=esc_attr($packaged_date);?>">
	<a class="color-black grid-x flex-dir-column align-justify" href="<?=esc_url( get_permalink() );?>" rel="bookmark">
		<div>
			<div class="thumb-wrap">
				<?php the_post_thumbnail('beer-archive'); ?>
			</div>
			<header class="entry-header">
				<?php
					the_title( '<h2 class="entry-title beer-name h4">', '</h2>' );
				?>
				<?php
				echo '<div class="color-black">';
				if ( has_excerpt() ) {
					// If there is a custom excerpt, display it
					the_excerpt();
				} else {
					// If there is no custom excerpt, create one from the first 20 characters of the content
					$content = get_the_content();
					$trimmed_content = mb_substr( $content, 0, 20 ) . '...'; // Get the first 20 characters and append ellipsis
					echo '<p>' . esc_html( $trimmed_content ) . '</p>';
				}
				echo '</div>';
				?>
				<?php if( !empty($abv) || $packaged_date ):?>
					<div class="meta p color-light-blue">
						<?php if( !empty($abv) ):?>
							<div>ABV: <?=esc_html($abv);?>%</div>	
						<?php endif;?>
						<?php if( !empty($packaged_date) ):
							$date = DateTime::createFromFormat( 'Ymd', $packaged_date );
						?>
							<div class="hide">Packaged Date: <span class="brew-date"><?=esc_html( $date->format( 'm/d/Y' ) );?></span></div>	
						<?php endif;?>
					</div>
				<?php endif;?>
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
