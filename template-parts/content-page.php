<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

?>

<article id="post-<?php the_ID(); ?>">
    <?php 
        if( get_field('full_width_banner_image') ) {
            get_template_part('template-parts/banner', 'full-width-image');
        }
    ?>
        <div class="entry-content">
        <div class="grid-container">
            <div class="grid-x grid-padding-x align-center">
                <div class="content-wrap cell small-12 large-11 xlarge-10">
                    <?php the_content();?>
                </div>
            </div>
        </div>
        </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
<div class="gradient-border"></div>

