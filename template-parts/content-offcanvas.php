<?php
/**
 * The template part for displaying offcanvas content
 *
 * For more info: https://jointswp.com/docs/off-canvas-menu/
 */
 
 $global_cta_icon_links = get_field('global_cta_icon_links', 'option') ?? null;
 $global_order_online_link = get_field('global_order_online_link', 'option') ?? null;
?>

<div class="off-canvas position-right" id="off-canvas" data-off-canvas>

	<div class="inner grid-x flex-dir-column align-justify">
		<div>
			<ul class="close-menu menu grid-x align-right">
				<!-- <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> -->
				<li>
					<button class="menu-toggle no-style font-header grid-x grid-padding-x align-right align-middle" type="button" data-toggle="off-canvas">
						<div class="cell shrink font-header">
							<b>Close</b>
						</div>
						<div class="cell shrink">
							<svg xmlns="http://www.w3.org/2000/svg" width="29.816" height="29.816"><defs><filter id="a" x="0" y="0" width="29.816" height="29.816" filterUnits="userSpaceOnUse"><feOffset dx="1" dy="1"/><feGaussianBlur result="blur"/><feFlood/><feComposite operator="in" in2="blur"/><feComposite in="SourceGraphic"/></filter></defs><g filter="url(#a)"><path data-name="ic_close_24px" d="M28.816 2.9 25.914 0 14.408 11.506 2.9 0 0 2.9l11.506 11.508L0 25.914l2.9 2.9L14.408 17.31l11.506 11.506 2.9-2.9L17.31 14.408Z" fill="#8b8b8b"/></g></svg>
						</div>
					</button>
					
				</li>
			</ul>
			<?php trailhead_off_canvas_nav(); ?>
		</div>
		<?php if( !empty( $global_cta_icon_links ) || !empty( $global_order_online_link ) ):?>
			<div class="icon-links-order-link cell font-heading">
				<ul class="grid-x grid-padding-x no-bullet align-middle align-center">
					<?php if( $global_cta_icon_links ):
						foreach( $global_cta_icon_links as $global_cta_icon_link ):
							$custom_class = $global_cta_icon_link['custom_class'] ?? null;
							$icon = $global_cta_icon_link['white_icon'] ?? null;
							$link = $global_cta_icon_link['link'] ?? null;
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
					?>
						<li class="icon-link cell shrink <?=esc_attr( $custom_class );?>">
							<a class="grid-x nowrap align-middle color-yellow" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
								<?php if( !empty( $icon ) ) {
									$imgID = $icon['ID'];
									$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
									$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
									echo $img;
								}?>
								<span><?php echo esc_html( $link_title ); ?></span>
							</a>
						</li>
					<?php endforeach; endif;?>
					<?php 
					$link = $global_order_online_link ?? null;
					if( $link ): 
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<li class="order-link cell shrink">
							<a class="button grid-x chev-btn align-middle" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
								<span><?php echo esc_html( $link_title ); ?></span>
								<svg xmlns="http://www.w3.org/2000/svg" width="12.35" height="20"><path d="M2.35 0 0 2.35 7.633 10 0 17.65 2.35 20l10-10Z" fill="#fff"/></svg>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		<?php endif;?>
	</div>

	<?php if ( is_active_sidebar( 'offcanvas' ) ) : ?>

		<?php dynamic_sidebar( 'offcanvas' ); ?>

	<?php endif; ?>

</div>
