<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trailhead
 */
 // Pre-footer CTA
 $pfcta_background_image = get_field('pfcta_background_image', 'options') ?? null;
 $pfcta_heading = get_field('pfcta_heading', 'options') ?? null;
 $global_cta_icon_links = get_field('global_cta_icon_links', 'option') ?? null;
 $global_order_online_link = get_field('global_order_online_link', 'option') ?? null;
 
 // Footer
 $footer_logo = get_field('footer_logo', 'option') ?? null;
 $social_menu_items = wp_get_nav_menu_items(get_nav_menu_locations()['social-links']);
 $subfooter_links = get_field('subfooter_links', 'option') ?? null;
 $phone_number = get_field('contact_phone_number', 'option') ?? null;
 $street_address = get_field('contact_street_address', 'option') ?? null;
 $city_state_zip_code = get_field('contact_city_state_zip_code', 'option') ?? null;
 $directions_url = get_field('contact_directions_url', 'option') ?? null;
 $hours = get_field('contact_hours', 'option') ?? null;

?>
				<?php if( !empty( $pfcta_background_image) || !empty(  $pfcta_heading ) || !empty( $global_cta_icon_links ) || !empty( $global_order_online_link ) ):?>
					<section class="prefooter-cta has-bg has-object-fit">
						<?php if(  !empty( $pfcta_background_image ) ) {
							$imgID =  $pfcta_background_image['ID'];
							$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
							$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "object-fit-img", "alt"=>$img_alt] );
							echo $img;
						}?>
						<div class="bg mask"></div>
						
						<?php if( !empty( $global_cta_icon_links ) || !empty( $global_order_online_link ) || !empty(  $pfcta_heading ) ):?>
							<div class="grid-container position-relative">
								<div class="header grid-x grid-padding-x">
									<div class="cell small-12">
										<?php if( !empty(  $pfcta_heading ) ):?>
											<h2 class="color-white text-center"><?=esc_html( $pfcta_heading );?></h2>
										<?php endif;?>
									</div>
								</div>
								<?php if( !empty( $global_cta_icon_links ) || !empty( $global_order_online_link ) ):?>
									<div class="icon-links-order-link font-heading">
										<ul class="grid-x grid-padding-x no-bullet align-middle align-center">
											<?php if( $global_cta_icon_links ):
												foreach( $global_cta_icon_links as $global_cta_icon_link ):
												$icon = $global_cta_icon_link['white_icon'] ?? null;
												$link = $global_cta_icon_link['link'] ?? null;
												$link_url = $link['url'];
												$link_title = $link['title'];
												$link_target = $link['target'] ? $link['target'] : '_self';
											?>
												<li class="icon-link cell shrink">
													<a class="grid-x align-middle color-white" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
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
						<?php endif;?>
					</section>
				<?php endif;?>
				

				<footer id="colophon" class="site-footer bg-blue">
					<div class="grid-container position-relative">
						<div class="top grid-x grid-padding-x text-center">
							<?php
								if( !empty( $footer_logo) ) {								
									$imgID = $footer_logo['ID'];
									$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
									$img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "", "alt"=>$img_alt] );
									echo '<div class="logo-wrap cell small-12">';
									echo $img;
									echo '</div>';
								}
							?>
							<?php 
								if( $social_menu_items) {
									echo '<div class="social-wrap cell small-12">';
										trailhead_social_links();
									echo '</div>';
								}
							?>
						</div>
						<div class="contact-menu-wrap grid-x grid-padding-x">
							<?php if( !empty($phone_number) || !empty($street_address) || !empty($city_state_zip_code) || !empty($directions_url) || !empty($hours) ):?>
								<div class="footer-col contact-info cell small-12 tablet-4 color-pale-blue">
									<?php if( !empty($street_address) || !empty($city_state_zip_code) || !empty($directions_url) ):?>
										<div class="address">
											<h3>Visit Us</h3>
											<?php if( !empty($street_address) ):?>
												<div><?=esc_html( $street_address );?></div>
											<?php endif;?>
											<?php if( !empty($city_state_zip_code) || !empty($directions_url) ):?>
												<div><?=esc_html( $city_state_zip_code );?> - 
													<?php if( !empty($directions_url) ):?>
														<a class="color-yellow" href="<?=$directions_url;?>" target="_blank" aria-label="Opens directions in a new tab">map</a>	
													<?php endif;?>
												</div>
											<?php endif;?>
										</div>
									<?php endif;?>
									
									
									<?php if( !empty($phone_number) ):?>
										<div class="phone">
											Call: <a class="color-pale-blue" href="tel:<?=esc_html( $phone_number );?>"><?=esc_html( $phone_number );?></a>
										</div>
									<?php endif;?>

									<?php if( !empty($hours) ):?>
										<div class="hours">
											<div>
												<?=wp_kses_post( $hours );?>
											</div>
										</div>
									<?php endif;?>
									<?php 
									$link = $global_order_online_link;
									if( $link ): 
										$link_url = $link['url'];
										$link_title = $link['title'];
										$link_target = $link['target'] ? $link['target'] : '_self';
										?>
										<div>
											<a class="button chev-btn grid-x align-middle bg-yellow" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
												<span><?php echo esc_html( $link_title ); ?></span>
												<svg xmlns="http://www.w3.org/2000/svg" width="12.35" height="20"><path d="M2.35 0 0 2.35 7.633 10 0 17.65 2.35 20l10-10Z" fill="#fff"/></svg>
											</a>
										</div>
									<?php endif; ?>
								</div>
							<?php endif;?>
							<div class="footer-col nav-menu cell small-12 tablet-auto">
								<?php trailhead_footer_menu();?>
							</div>
						</div>
					</div>
					<div class="site-info color-light-blue">
						<div class="grid-container fluid">
							<div class="grid-x grid-padding-x">
								<div class="cell small-12 tablet-auto">
									<p>
										&copy;<?= date("Y");?>
										<?php if( !empty(get_field('copyright_text', 'option') ) ){
											echo get_field('copyright_text', 'option');	
										};?>
										<?php if( !empty($subfooter_links) ):
											foreach($subfooter_links as $subfooter_link):	
											$link = $subfooter_link['link'] ?? null;
												if( $link ): 
										?>
											<span>
												<span>|</span>
												<?php 
													$link_url = $link['url'];
													$link_title = $link['title'];
													$link_target = $link['target'] ? $link['target'] : '_self';
													?>
													<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
											</span>
										<?php endif; endforeach; endif;?>
									</p>
								</div>
								<div class="cell small-12 tablet-shrink">
									<p>
										Website by:
										<a class="uppercase" href="https://gopipedream.com/" target="_blank">
											Pipedream
										</a>
									</p>
								</div>
							</div>
						</div>
					</div>
				</footer><!-- #colophon -->
					
			</div><!-- #page -->
			
		</div>  <!-- end .off-canvas-content -->
							
	</div> <!-- end .off-canvas-wrapper -->
					
<?php wp_footer(); ?>

</body>
</html>
