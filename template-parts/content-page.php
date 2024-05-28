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
        if( get_field('banner_slides') ) {
            get_template_part('template-parts/section', 'page-banner');
        }
    ?>
    <div class="entry-content has-top-repeating-bg position-relative">
    <div class="grid-container position-relative">
        <div class="grid-x grid-padding-x align-center">
            <div class="content-wrap cell small-12">
                <?php the_content();?>
            </div>
        </div>
    </div>
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
<div class="gradient-border"></div>

