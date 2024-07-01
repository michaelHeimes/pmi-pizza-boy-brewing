<?php

/**
 * Large Colored Copy Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'pb-menu' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'pb-menu';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$menu_categories = get_field('menu_categories');

?>
<section id="<?php echo esc_attr($id); ?>" class="module block <?php echo esc_attr($className); ?>">
    <div id="top"></div>
    <?php if( !empty( $menu_categories ) ):?>
    <ul class="no-bullet grid-x grid-padding-x align-center button-grid" id="<?php echo esc_attr($id); ?>" data-smooth-scroll data-animation-easing="swing" data-offset="250">
        <?php $i = 1; foreach($menu_categories as $menu_category):
            $title = $menu_category['title'];    
        ?>
            <li class="cell shrink grid-btn-wrap">
                <a class="uppercase button bg-yellow" href="#<?= sanitize_title($title);?>">
                    <?= esc_attr( $title );?>
                </a>
            </li>
        <?php $i++; endforeach;?>        
    </ul>
    <div id="stick-to-bottom" class="content-wrap">
        <?php $i = 1; foreach($menu_categories as $menu_category):
            $title = $menu_category['title'] ?? null;    
            $content = $menu_category['content'] ?? null;    
        ?>
        <div id="<?= sanitize_title($title);?>" class="menu-section">
            <div <?php if($i == 1):?>id="top-anchor"<?php endif;?> class="content h3-margins">
                <?= $content;?>
                <?php if($i == 1):?>
                    <div class="btt-wrap" data-smooth-scroll data-sticky-container>
                        <div class="sticky" data-sticky data-sticky-on="small" data-stick-to="bottom" data-top-anchor="top-anchor:bottom" data-btm-anchor="stick-to-bottom:bottom">
                        <a id="menu-btt" class="grid-x align-middle p font-heading uppercase color-blue" href="#top" >
                            <span>Top</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18.163" height="18.163"><path d="m0 9.082 1.6 1.6 6.346-6.334v13.815h2.27V4.348l6.334 6.346 1.612-1.612L9.082 0Z" fill="#002d5c"/></svg>
                        </a>
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </div>
    <?php $i++; endforeach;?>  
    </div>
    <?php endif;?>
</section>