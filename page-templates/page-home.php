<?php
/**
 * Template name: Home Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$fields = get_fields();
// Hero Fields
$hero_top_headline = $fields['hero_top_headline'] ?? null;
$hero_bottom_headline = $fields['hero_bottom_headline'] ?? null;
$slider_transition_delay = $fields['hero_slider_transition_delay'] ?? null;
$slides = $fields['hero_slides'] ?? null;

// Copy & Image
$ci_background_image = $fields['ci_background_image'] ?? null;
$ci_copy =  $fields['ci_copy'] ?? null;
$ci_image =  $fields['ci_image'] ?? null;

// CTA Slides
$ctas_slider_transition_delay = $fields['ctas_slider_transition_delay'] ?? null;
$ctas_slides = $fields['ctas_slides'] ?? null;

// Card Slider
$cscta_background_image = $fields['cscta_background_image'] ?? null;
$cscta_slider_transition_delay = $fields['cscta_slider_transition_delay'] ?? null;
$cscta_slider_images = $fields['cscta_slider_images'] ?? null;
$cscta_copy = $fields['cscta_copy'] ?? null;
$cscta_button_links = $fields['cscta_button_links'] ?? null;
?>
<div class="content">
	<div class="inner-content">

		<main id="primary" class="site-main">
	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header page-banner hero-banner has-bg grid-x align-middle style-hero-slider bg-blue text-center">
					<div class="bg">
						<div class="accent-wrap"></div>
						<?php if( !empty( $slides ) || !empty($hero_top_headline) || !empty($hero_bottom_headline) ):?>
							<div class="bg-slider" data-delay="<?= esc_attr( $slider_transition_delay );?>">
								<div class="swiper-wrapper">
									<?php if( !empty( $slides ) ): $i = 1; foreach($slides as $slide):
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
									<?php $i++; endforeach; endif;?>
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
					</div>
					<div class="content position-relative">
						<div class="grid-container">				
							<div class="grid-x grid-padding-x align-center">
								<div class="cell small-12">
									<?php if( !empty($hero_top_headline) || !empty($hero_bottom_headline) ):?>
										<h1 class="color-white">
											<?php if( !empty($hero_top_headline) ) {
												echo esc_html( $hero_top_headline );
											};?>
											<?php if( !empty($hero_bottom_headline) ):?>
											<br><span><?=esc_html( $hero_bottom_headline );?></span>
											<?php endif;?>
										</h1>
									<?php endif;?>
								</div>
							</div>
						</div>
					</div>
				</header>
			
				<section class="entry-content" itemprop="text">
					
					<?php if( !empty($ci_background_image) || !empty($ci_copy) || !empty($ci_image) ):?>
						<section class="copy-image bg-blue has-bg">
							<?php if( !empty($ci_background_image) ):?>
								<div class="bg" style="background-image: url(<?=esc_url($ci_background_image['url']);?>)"></div>
							<?php endif;?>
							<div class="grid-container">
								<div class="grid-x grid-padding-x">
									<?php if( !empty($ci_copy) ):?>
										<div class="cell small-12 medium-7 color-pale-blue">
											<?=wp_kses_post( $ci_copy );?>
										</div>
									<?php endif;?>
									<?php if( !empty( $ci_image ) ) {
										$imgID = $ci_image['ID'];
										$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
										$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
										echo '<div class="img-wrap cell small-12 medium-5 show-for-medium">';
										echo $img;
										echo '</div>';
									}?>
								</div>
							</div>
						</section>
					<?php endif;?>
					
					<?php if( !empty($ctas_slides) ):?>
						<section class="cta-slides position-relative">
							<div class="home-cta-slider" data-delay="<?= esc_attr( $ctas_slider_transition_delay );?>">
								<div class="swiper-wrapper">
									<?php foreach( $ctas_slides as $ctas_slide ):
										$layout = $ctas_slide['layout'] ?? null;	
										$image = $ctas_slide['image'] ?? null;	
										$title = $ctas_slide['title'] ?? null;	
										$button_link = $ctas_slide['button_link'] ?? null;	
										$linked_title = $ctas_slide['linked_title'] ?? null;	
									?>
										<div class="swiper-slide bg-blue has-object-fit layout-<?=esc_attr( $layout );?>">
											<?php if( !empty( $image ) ) {
												$imgID = $image['ID'];
												$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
												$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "object-fit-img", "alt"=>$img_alt] );
												echo $img;
											}?>
											<div class="inner position-relative grid-x flex-dir-column align-middle<?php if( $layout == 'linked-title' || $layout == 'just-title' ) { echo ' align-right'; } else { echo ' align-center'; };?>">
												<?php if( $layout == 'title-button' || $layout == 'just-title' ):?>
													<?php if( !empty($title) ):?>
														<h2<?php if ($layout == 'just-title' ):?> class="text-center"<?php endif;?>><?=esc_html( $title );?></h2>
													<?php endif;?>
													<?php 
													$link = $button_link;
													if( $link && $layout != 'just-title' ): 
														$link_url = $link['url'];
														$link_title = $link['title'];
														$link_target = $link['target'] ? $link['target'] : '_self';
														?>
														<a class="button bg-yellow chev-btn grid-x align-middle" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
															<span><?php echo esc_html( $link_title ); ?></span>
															<svg xmlns="http://www.w3.org/2000/svg" width="12.35" height="20"><path d="M2.35 0 0 2.35 7.633 10 0 17.65 2.35 20l10-10Z" fill="#fff"/></svg>
														</a>
													<?php endif; ?>
												<?php endif;?>
												<?php if( $layout == 'linked-title' && !empty( $linked_title ) ):
													$link = $linked_title;
													$link_url = $link['url'];
													$link_title = $link['title'];
													$link_target = $link['target'] ? $link['target'] : '_self';	
												?>
													<a class="chev-link grid-x align-middle" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
														<h2><?php echo esc_html( $link_title ); ?></h2>
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50.725" height="70.996" viewBox="0 0 50.725 70.996">
														  <defs>
															<filter id="ic_chevron_right_24px" x="0" y="0" width="50.725" height="70.996" filterUnits="userSpaceOnUse">
															  <feOffset dy="3" input="SourceAlpha"/>
															  <feGaussianBlur stdDeviation="3" result="blur"/>
															  <feFlood flood-opacity="0.808"/>
															  <feComposite operator="in" in2="blur"/>
															  <feComposite in="SourceGraphic"/>
															</filter>
														  </defs>
														  <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#ic_chevron_right_24px)">
															<path id="ic_chevron_right_24px-2" data-name="ic_chevron_right_24px" d="M14.817,6,8.59,12.227,28.817,32.5,8.59,52.769,14.817,59l26.5-26.5Z" transform="translate(0.41)" fill="#fff"/>
														  </g>
														</svg>

													</a>
												<?php endif;?>
											</div>
										</div>
									<?php endforeach;?>
								</div>
								<div class="swiper-button-next">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49 93"><path data-name="Subtraction 1" d="M46.5 93A46.512 46.512 0 0 1 28.4 3.654 46.209 46.209 0 0 1 46.5 0c.831 0 1.672.022 2.5.066v92.868c-.835.044-1.675.066-2.5.066Z" fill="#f9ae4b"/><path d="M22.095 58.991 35.421 46.5 22.095 34.009l4.1-3.837L43.655 46.5 26.198 62.828Z" fill="#fff"/></svg>
								</div>
								<div class="swiper-button-prev">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49 93"><path data-name="Subtraction 1" d="M2.5 93A46.512 46.512 0 0 0 20.6 3.655 46.209 46.209 0 0 0 2.5 0C1.669 0 .828.022 0 .066v92.868c.835.044 1.675.066 2.5.066Z" fill="#f9ae4b"/><path d="M26.904 58.991 13.578 46.5l13.326-12.491-4.1-3.837L5.344 46.5l17.458 16.328Z" fill="#fff"/></svg>
								</div>
							</div>
						</section>
					<?php endif;?>

					<?php if( !empty($cscta_background_image) || !empty($cscta_slider_images) || !empty($cscta_copy) || !empty($cscta_button_links) ):?>
						<section class="cards-slider-copy-cta bg-light-blue has-bg has-object-fit">
							<?php if( !empty( $cscta_background_image ) ) {
								$imgID = $cscta_background_image['ID'];
								$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
								$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "object-fit-img", "alt"=>$img_alt] );
								echo $img;
								echo '<div class="bg mask"></div>';
							}?>
							<div class="grid-container position-relative">
								<div class="grid-x grid-padding-x align-middle">
									<?php if( !empty($cscta_slider_images) ):?>
										<div class="cell small-12 tablet-5 large-4">
											<div class="cards-slider" data-delay="<?= esc_attr( $cscta_slider_transition_delay );?>">
												<div class="swiper-wrapper">
													<?php foreach( $cscta_slider_images as $image ):
														if( !empty( $image ) ) {
															$imgID = $image['ID'];
															$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
															$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
															echo '<div class="swiper-slide">';
															echo '<div class="img-wrap">';
															echo $img;
															echo '</div>';
															echo '</div>';
														}
													endforeach;?>
												</div>
												<?php if( !empty( $cscta_slider_images ) && count($cscta_slider_images) > 1 ):?>
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
										</div>
									<?php endif;?>
									<?php if( !empty($cscta_copy) ):?>
										<div class="cell small-12 tablet-7 large-8 color-pale-blue">
											<div class="copy-wrap">
												<?=wp_kses_post( $cscta_copy );?>
											</div>
										</div>
									<?php endif;?>
								</div>
								<?php if( !empty($cscta_button_links) ):?>
									<div class="button-links grid-x grid-padding-x align-center button-grid">
										<?php foreach($cscta_button_links as $cscta_button_link):
											$link = $cscta_button_link['link'];
											if( $cscta_button_link && $link ):
												$link_url = $link['url'];
												$link_title = $link['title'];
												$link_target = $link['target'] ? $link['target'] : '_self';
												?>
												<div class="cell shrink">
													<a class="button chev-btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
														<span><?php echo esc_html( $link_title ); ?></span>
														<svg xmlns="http://www.w3.org/2000/svg" width="12.35" height="20"><path d="M2.35 0 0 2.35 7.633 10 0 17.65 2.35 20l10-10Z" fill="#fff"/></svg>
													</a>
												</div>
											<?php endif;	
										endforeach;?>
									</div>
								<?php endif;?>
							</div>
						</section>
					<?php endif;?>
					
					
				</section> <!-- end article section -->
						
				<footer class="article-footer">
					 <?php wp_link_pages(); ?>
				</footer> <!-- end article footer -->
					
			</article><!-- #post-<?php the_ID(); ?> -->
	
		</main><!-- #main -->
			
	</div>
</div>

<?php
get_footer();