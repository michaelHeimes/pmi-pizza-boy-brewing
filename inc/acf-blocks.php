<?php

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'accordion',
            'title'             => __('Block: Accordion'),
            'description'       => __('Block: Accordion'),
            'render_template'   => 'template-parts/blocks/accordion.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'custom', 'block', 'accordion' ),
        ));
        
        acf_register_block_type(array(
            'name'              => 'button-group',
            'title'             => __('Block: Button Group'),
            'description'       => __('Block: Button Group'),
            'render_template'   => 'template-parts/blocks/button-group.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'custom', 'block', 'button', 'buttons', 'group' ),
        ));
        
        acf_register_block_type(array(
            'name'              => 'tabs',
            'title'             => __('Block: Tabbed Content'),
            'description'       => __('Block: Tabbed Content'),
            'render_template'   => 'template-parts/blocks/tabbed-content.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'custom', 'block', 'tabs', 'tabbed' ),
        ));
        
        acf_register_block_type(array(
            'name'              => 'menu',
            'title'             => __('Block: Menu'),
            'description'       => __('Block: Menu'),
            'render_template'   => 'template-parts/blocks/menu.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'custom', 'block', 'menu'),
        ));
        
    }
}

// CPT Archives Post Per page
function hwl_home_pagesize( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'ad_property' ) ) {
        $query->set( 'posts_per_page', 9999999 );
        return;
    }

    if ( ! is_admin() && $query->is_main_query() && is_tax( 'ad_prop_type' ) ) {
        $query->set( 'posts_per_page', 9999999 );
        return;
    }

    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'news_post' ) ) {
        $query->set( 'posts_per_page', 7 );
        return;
    }

}
add_action( 'pre_get_posts', 'hwl_home_pagesize', 1 );