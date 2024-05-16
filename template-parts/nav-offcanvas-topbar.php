<?php
/**
 * The off-canvas menu uses the Off-Canvas Component
 *
 * For more info: https://jointswp.com/docs/off-canvas-menu/
 */
 $header_logo = get_field('header_logo', 'option') ?? null;
 $global_cta_icon_links = get_field('global_cta_icon_links', 'option') ?? null;
 $global_order_online_link = get_field('global_order_online_link', 'option') ?? null;
?>

<div class="top-bar-wrap">

	<div class="pre-header">
		<div class="grid-container fluid">
			<div class="grid-x grid-padding-x align-middle">
				<?php if( !empty( $header_logo ) ):?>
					<div class="cell shrink">
						<ul class="menu">
							<li class="logo"><a href="<?php echo home_url(); ?>">
								<?php
									$imgID =  $header_logo ['ID'];
									$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
									$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
									echo '<div class="img-wrap">';
									echo $img;
									echo '</div>';
								?>
							</a></li>
						</ul>
					</div>
				<?php endif; ?>
				<?php if( !empty( $global_cta_icon_links ) || !empty( $global_order_online_link ) ):?>
					<div class="icon-links-order-link cell auto font-heading">
						<ul class="grid-x grid-padding-x no-bullet align-middle align-right">
							<?php if( $global_cta_icon_links ):
								foreach( $global_cta_icon_links as $global_cta_icon_link ):
								$icon = $global_cta_icon_link['icon'] ?? null;
								$link = $global_cta_icon_link['link'] ?? null;
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
							?>
								<li class="cell shrink">
									<a class="grid-x align-middle color-yellow" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
										<?php if( !empty( $icon ) ) {
											$imgID = $icon['ID'];
											$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
											$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
											echo '<div class="icon-wrap">';
											echo $img;
											echo '</div>';
										}?>
										<span><?php echo esc_html( $link_title ); ?></span>
									</a>
								</li>
							<?php endforeach; endif;?>
							<?php 
							$link = $global_order_online_link;
							if( $link ): 
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<li class="cell shrink">
									<a class="button gir-x align-middle" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
										<span><?php echo esc_html( $link_title ); ?></span>
										<svg xmlns="http://www.w3.org/2000/svg" width="12.35" height="20"><path d="M2.35 0 0 2.35 7.633 10 0 17.65 2.35 20l10-10Z" fill="#fff"/></svg>
									</a>
								</li>
							<?php endif; ?>
						</ul>
					</div>
				<?php endif;?>
			</div>
		</div>
	</div>

	<div class="top-bar" id="top-bar-menu">
		
	
		<div class="top-bar-left float-left">
			<div class="show-for-tablet">
				<?php trailhead_top_nav();?>
			</div>
			<div class="site-branding show-for-sr">
				<?php
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$trailhead_description = get_bloginfo( 'description', 'display' );
				if ( $trailhead_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $trailhead_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
						
		</div>
		<div class="top-bar-right show-for-tablet">
		</div>
		<div class="menu-toggle-wrap top-bar-right float-right hide-for-tablet">
			<ul class="menu">
				<!-- <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> -->
				<li><a id="menu-toggle" data-toggle="off-canvas"><span></span><span></span><span></span></a></li>
			</ul>
		</div>
	</div>
	
</div>