<?php
// vars.
$obj_id     = get_field( 'obj_id' );
$image_type = get_field( 'img_type' );
$size       = 'ww-btn-img'; // (thumbnail, medium, large, full or custom size)

if ( 'file' === $image_type ) {
	$image = get_field( 'img' );
} else {
	$image = get_post_thumbnail_id( $obj_id );
}

if ( $image ) {
	$img = wp_get_attachment_image( $image, $size );
}

$head    = get_field( 'title' );

?>
<div class="box box-link-btn-img">
<a class="btn-link" href="<?php echo ( wp_doing_ajax() ? '#' : esc_url( get_permalink( $obj_id ) ) ); ?>">
		<figure class="wp-block-image">
			<?php echo $img; ?>
		</figure>
		<div class="btn-head">
				<h3><?php echo $head; ?></h3>
		</div>
	</a>
</div>
