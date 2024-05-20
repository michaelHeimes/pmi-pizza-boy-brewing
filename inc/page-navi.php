<?php // Borrowed with love from FoundationPress
function trailhead_page_navi() {
	global $wp_query;
	$big = 999999999; // This needs to be an unlikely integer
	// For more options and info view the docs for paginate_links()
	// http://codex.wordpress.org/Function_Reference/paginate_links
	$paginate_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 5,
		'prev_next' => true,
		'prev_text' => __( '<svg xmlns="http://www.w3.org/2000/svg" width="9.609" height="15.561"><path d="M7.781 0 9.61 1.828 3.67 7.781l5.94 5.952-1.828 1.828L0 7.781Z" fill="#002D5C"/></svg><span>Prev</span>', 'trailhead' ),
		'next_text' => __( '<svg xmlns="http://www.w3.org/2000/svg" width="9.609" height="15.561"><path d="M1.829 0 0 1.828 5.939 7.78 0 13.733l1.829 1.828 7.781-7.78Z" fill="#002D5C"/></svg><span>Next</span>', 'trailhead' ),
		'type' => 'list',
	) );
	$paginate_links = str_replace( "<ul class='page-numbers'>", "<ul class='pagination nav-links font-header'>", $paginate_links );
	$paginate_links = str_replace( '<li><span class="page-numbers dots">', "<li><a href='#'>", $paginate_links );
	$paginate_links = str_replace( "<li><span class='page-numbers current'>", "<li class='current'>", $paginate_links );
	$paginate_links = str_replace( '</span>', '</a>', $paginate_links );
	$paginate_links = str_replace( "<li><a href='#'>&hellip;</a></li>", "<li><span class='dots'>&hellip;</span></li>", $paginate_links );
	$paginate_links = preg_replace( '/\s*page-numbers/', '', $paginate_links );
	// Display the pagination if more than one page is found.
	if ( $paginate_links ) {
		echo '<div class="page-navigation">';
		echo $paginate_links;
		echo '</div><!--// end .pagination -->';
	}
}