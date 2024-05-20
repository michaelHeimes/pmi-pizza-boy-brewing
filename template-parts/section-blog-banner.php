<?php
$title = $args['title'];
$featured_image_ID = $args['featured_image_ID'];
?>
<header class="entry-header blog-banner page-banner has-object-fit position-relative">
	<?php if( !empty( $featured_image_ID ) ) {
		$imgID = $featured_image_ID;
		$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
		$img = wp_get_attachment_image( $imgID, 'blog-banner', false, [ "class" => "object-fit-img", "alt"=>$img_alt] );
		echo $img;
	}?>
</header><!-- .entry-header -->