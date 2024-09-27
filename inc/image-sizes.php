<?php
function add_custom_sizes() {
	// Beer post
	add_image_size( 'beer-post-banner', 804, 1000, true );
	add_image_size( 'beer-archive', 628, 580, true );
}
add_action('after_setup_theme','add_custom_sizes');