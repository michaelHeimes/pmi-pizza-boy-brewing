<?php 
$slider_transition_delay = get_field('banner_slider_transition_delay') ?? null;
$slides = get_field('banner_slides') ?? null;
?>
<header class="entry-header page-banner has-bg grid-x align-middle style-banner-slider cta-page-banner">
	<?php if( !empty( $slides ) ):?>
		<div class="bg bg-slider" data-delay="<?= esc_attr( $slider_transition_delay );?>">
			<div class="swiper-wrapper">
				<?php foreach($slides as $slide):
					$type = $slide['media_type'];
				?>
					<div class="swiper-slide">
						<?php if( $type == 'image' && !empty( $slide['image'] ) ) {
							$imgID = $slide['image']['ID'];
							$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
							$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
							echo '<div class="img-wrap">';
							echo $img;
							echo '</div>';
						}?>
						<?php if( $type == 'video' && !empty( $slide['video_file'] ) ):?>
							<div class="video-wrap">
								<video width="1600" preload="none" height="900" playsinline loop muted>
								  <source src="<?= esc_url( $slide['video_file']['url'] );?>" type="video/mp4" />
								</video>
							</div>
						<?php endif;?>
					</div>
				<?php endforeach;?>
			</div>
			<?php if( !empty( $slides ) && count($slides) > 1 ):?>
				<div class="grid-container pagination-container">
					<div class="grid-x grid-padding-x align-center">
						<div class="cell small-12">
							<div class="position-relative">
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
				</div>
			<?php endif;?>
		</div>
	<?php endif;?>
</header>
