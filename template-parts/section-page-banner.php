<?php 
$slider_transition_delay = get_field('banner_slider_transition_delay') ?? null;
$slides = get_field('banner_slides') ?? null;

?>
<header class="entry-header page-banner has-bg grid-x align-middle style-banner-slider">
	<?php if( !empty( $slides ) ):?>
		<div class="bg bg-slider" data-delay="<?= esc_attr( $slider_transition_delay );?>">
			<div class="swiper-wrapper">
				<?php foreach($slides as $slide):
					$type = $slide['media_type'] ?? null;
					$title = $slide['title'] ?? null;
				?>
					<div class="swiper-slide">
						<?php if( $type == 'image' && !empty( $slide['image'] ) ) :?>
							<div class="img-wrap position-relative">
								<?php
								$imgID = $slide['image']['ID'];
								$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
								$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
								echo $img;?>
								<?php if( !empty($title) ):?>
								<div class="grid-container position-relative height-100">
									<div class="grid-x grid-padding-x height-100">
										<div class="cell small-12 medium-10 tablet-9 large-8 xlarge-6 height-100 grid-x align-middle">
											<h1 class="color-white"><?=esc_html($title);?></h1>
										</div>
									</div>
								</div>
								<?php endif;?>
							</div>
							
						<?php endif;?>
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
				<div class="grid-container pagination-container position-relative">
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
