<?php
/**
 * The template part for displaying offcanvas content
 *
 * For more info: https://jointswp.com/docs/off-canvas-menu/
 */
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
		<div class="grid-x grid-padding-x buttons-group">
			<?php 
			$link = get_field('mobile_nav_button_link', 'option');
			if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
				?>
				<div class="cell shrink">
					<a class="button chev-link no-bg grid-x align-center color-white" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
						<span><?php echo esc_html( $link_title ); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="12.746" height="20.641" viewBox="0 0 12.746 20.641"> <path id="ic_chevron_right_24px" d="M11.015,6,8.59,8.425l7.878,7.9-7.878,7.9,2.425,2.425L21.336,16.321Z" transform="translate(-8.59 -6)" fill="#ffffff"/></svg>
					</a>
				</div>
			<?php endif; ?>
			<?php 
			$link = get_field('sticky_get_started_cta', 'option');
			if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
				?>
				<div class="cell shrink">
					<a class="button chev-link grid-x align-center" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
						<span><?php echo esc_html( $link_title ); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="10.239" height="16.582" viewBox="0 0 10.239 16.582"><path id="ic_chevron_right_24px" d="M10.538,6,8.59,7.948l6.329,6.343L8.59,20.634l1.948,1.948,8.291-8.291Z" transform="translate(-8.59 -6)"/></svg>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( is_active_sidebar( 'offcanvas' ) ) : ?>

		<?php dynamic_sidebar( 'offcanvas' ); ?>

	<?php endif; ?>

</div>
