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
 $footer_logo = get_field('footer_logo', 'option') ?? null;
 $social_menu_items = wp_get_nav_menu_items(get_nav_menu_locations()['social-links']);
 $subfooter_links = get_field('subfooter_links', 'option') ?? null;
?>

				<footer id="colophon" class="site-footer bg-blue">
					<div class="grid-container position-relative">
						<div class="top grid-x grid-padding-x">
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
									echo '<div class="social-wrap cell small-12 medium-6">';
										trailhead_social_links();
									echo '</div>';
								}
							?>
						</div>
						<div class="contact-menu-wrap grid-x grid-padding-x">
							<?php if( !empty($phone_number) || !empty($street_address) || !empty($city_state_zip_code) || !empty($directions_url) || !empty($hours) ):?>
								<div class="footer-col contact-info cell small-12 tablet-shrink">
									<?php if( !empty($phone_number) ):?>
										<div>
											<h3>Contact Us</h3>
											Call/Text: <a href="tel:<?=esc_html( $phone_number );?>"><?=esc_html( $phone_number );?></a>
										</div>
									<?php endif;?>
									<?php if( !empty($street_address) || !empty($city_state_zip_code) || !empty($directions_url) ):?>
										<div>
											<h3>Visit Us</h3>
											<?php if( !empty($street_address) ):?>
												<div><?=esc_html( $street_address );?></div>
											<?php endif;?>
											<?php if( !empty($city_state_zip_code) || !empty($directions_url) ):?>
												<div><?=esc_html( $city_state_zip_code );?> - 
													<?php if( !empty($directions_url) ):?>
														<a href="<?=$directions_url;?>" target="_blank" aria-label="Opens directions in a new tab">directions</a>	
													<?php endif;?>
												</div>
											<?php endif;?>
										</div>
									<?php endif;?>
									<?php if( !empty($hours) ):?>
										<div>
											<h3>Hours</h3>
											<div>
												<?=wp_kses_post( $hours );?>
											</div>
										</div>
									<?php endif;?>
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
