<?php
// This file handles the admin area and functions - You can use this file to make changes to the dashboard.

/************* CUSTOMIZE ADMIN *******************/
// Custom Backend Footer
function trailhead_custom_admin_footer() {
// 	_e('<span id="footer-thankyou">Developed by <a href="https://proprdesign.com/" target="_blank">Propr Design</a></span>.', 'trailhead');
}

// adding it to the admin area
add_filter('admin_footer_text', 'trailhead_custom_admin_footer');

/* WP Editor
 */

	// Don't remove additional line breaks in editor
	// http://tinymce.moxiecode.com/wiki.php/Configuration
	function custom_tinymce_config( $init ) {
		$init['remove_linebreaks'] = false; 
		return $init;
	}
	add_filter('tiny_mce_before_init', 'custom_tinymce_config');

	function dg_tiny_mce_remove_h1( $in ) {
	        $in['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6;Preformatted=pre";
	    return $in;
	}
	//add_filter( 'tiny_mce_before_init', 'dg_tiny_mce_remove_h1' );


/**
 * Misc edits to the Wordpress Admin
 */

	// Remove useless dashboard widgets
	function remove_dashboard_widgets() {
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
		remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
		remove_meta_box('dashboard_primary', 'dashboard', 'normal');
		remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
	}
	add_action('admin_init', 'remove_dashboard_widgets');


	// add styleselect to editor
	function add_styleselect($buttons) {
		array_unshift($buttons, 'styleselect');
		return $buttons;
	}
	//add_filter('mce_buttons_2', 'add_styleselect');


	// add default styles to styleselect
	function add_styleselect_classes( $init_array ) {  
		// Define the style_formats array
		$style_formats = array(  
			// Each array child is a format with it's own settings
	        array(  
	            'title' => 'Large Blue Text',  
	            'block' => 'span',  
	            'classes' => 'large-blue-text',
	            'wrapper' => true,
	        ),
		);
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode( $style_formats );  
		
		return $init_array;  
	} 
	//add_filter( 'tiny_mce_before_init', 'add_styleselect_classes' ); 


	// add editor-style.css
	function theme_editor_style() {
		add_editor_style( get_template_directory_uri() . '/assets/styles/style.min.css' );
	}
	//add_action('init', 'theme_editor_style');


	// remove revisions meta box and recreate on right side for all post types
	function relocate_revisions_metabox() {
		$args = array(
		'public'   => true,
		'_builtin' => false
		); 
		$output = 'names'; // names or objects
		$post_types = get_post_types($args,$output); 
		foreach ($post_types  as $post_type) {
			remove_meta_box('revisionsdiv',$post_type,'normal'); 
			add_meta_box('revisionssidediv2', __('Revisions'), 'post_revisions_meta_box', $post_type, 'side', 'low');
		}
		
		// page 
		remove_meta_box('revisionsdiv','page','normal'); 
		add_meta_box('revisionssidediv2', __('Revisions'), 'post_revisions_meta_box', 'page', 'side', 'low');
		
		// post 
		remove_meta_box('revisionsdiv','post','normal'); 
		add_meta_box('revisionssidediv2', __('Revisions'), 'post_revisions_meta_box', 'post', 'side', 'low');
		
	}
	add_action('do_meta_boxes','relocate_revisions_metabox', 30);
	
	
	
	// add featured image instructions
	function featured_image_dimensions( $content, $post_id, $thumbnail_id ) {
			$help_text = '<p><b>Minimum Size:</b> 314px by 290px</p>';
			$help_text .= '<p><b>Minimum Size:</b> 628px by 580px</p>';
			return $help_text . $content;
		}
	add_filter( 'admin_post_thumbnail_html', 'featured_image_dimensions', 10, 3 );
	
	
	
	// Add custom admin column for event_date
	function custom_brew_columns($columns) {
		$columns['packaged_date'] = 'Packaged Date';
		return $columns;
	}
	add_filter('manage_beer-cpt_posts_columns', 'custom_brew_columns');
	
	// Display event_date in custom admin column with format m/d/Y
	function custom_brew_column_content($column, $post_id) {
		if ($column == 'packaged_date') {
			$event_date = get_field('packaged_date', $post_id); // Replace 'event_date' with your ACF field name
			if ($event_date) {
				$formatted_date = date('m/d/Y', strtotime($event_date));
				echo $formatted_date;
			}
		}
	}
	add_action('manage_beer-cpt_posts_custom_column', 'custom_brew_column_content', 10, 2);
	
	
	
	
	
	
	// Make the packaged_date column sortable
	function beer_cpt_sortable_columns($columns) {
		$columns['packaged_date'] = 'packaged_date';
		return $columns;
	}
	add_filter('manage_edit-beer-cpt_sortable_columns', 'beer_cpt_sortable_columns');
	
	// Add custom sorting for the packaged_date column
	function beer_cpt_column_orderby($query) {
		if (!is_admin()) {
			return;
		}
	
		$orderby = $query->get('orderby');
	
		if ('packaged_date' === $orderby) {
			$query->set('meta_key', 'packaged_date');
			$query->set('orderby', 'meta_value');
		}
	}
	add_action('pre_get_posts', 'beer_cpt_column_orderby');

