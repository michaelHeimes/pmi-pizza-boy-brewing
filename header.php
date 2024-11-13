<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trailhead
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="google-site-verification" content="wKPx7mQ3EIv9aQ7kgqQszWlPmSebEEkhNyOaWe1cUFg" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;500;600&family=Francois+One&display=swap" rel="stylesheet">
	
	<?php if( !empty( get_field('before_closing_header', 'option') ) ) {
		echo get_field('before_closing_header', 'option');
	};?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
			<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'trailhead' ); ?></a>
		
			<div class="sticky-container">
				<header class="site-header sticky bg-white" role="banner" data-stick data-margin-top="0" data-sticky-on="small">
					<?php get_template_part( 'template-parts/nav', 'offcanvas-topbar' ); ?>
				</header><!-- #masthead -->
			</div>
<?php get_template_part( 'interstitial' ); ?>	
				<div class="off-canvas-wrapper">
				
				<!-- Load off-canvas container. Feel free to remove if not using. -->			
				<?php get_template_part( 'template-parts/content', 'offcanvas' ); ?>
				
					<div class="off-canvas-content" data-off-canvas-content>
						<div id="page" class="site">
	