<?php
// vars.
$image_type = get_field( 'img_type' );
$link_type  = get_field( 'link_type' );
$btn_select = get_field( 'btn_select' );
$position   = get_field( 'position' );
$btn_text   = trim( get_field( 'btn_text' ) );
$btn_bool   = false;
$img        = false;

if ( ! $btn_text ) {
	$btn_text = esc_html__( 'Mehr', 'webwerk-acf-blocks' );
}

$size = 'ww-tile-horz'; // (thumbnail, medium, large, full or custom size)

if ( 'file' === $image_type ) {
	$image = get_field( 'img_id' );
} elseif ( 'post' === $image_type ) {
	$post_img_id = get_field( 'post_img_id' );
	$image       = get_post_thumbnail_id( $post_img_id );
}

if ( $image ) {
	$img = wp_get_attachment_image( $image, $size );
}

$external_target = null;

if ( 'internal' === $link_type ) {
	$obj_id = get_field( 'obj_id' );
	$url    = get_permalink( $obj_id );
} elseif ( 'external' === $link_type ) {
	$btn_bool        = true;
	$url             = get_field( 'url' );
	$external_target = ' target="_blank" title="' . esc_attr__( 'Seite öffnet in neuem Fenster', 'webwerk-acf-blocks' ) . '" aria-label="' . esc_attr__( 'Seite öffnet in neuem Fenster', 'webwerk-acf-blocks' ) . '"';
} else {
	$url = '';
}

$head    = get_field( 'title' );
$content = get_field( 'content' );
?>
<div class="box box-tile-horz-img bthi-<?php echo $position; echo ( 'none' === $link_type ) ? ' grid' : null; ?>">
	<?php if ( 'none' !== $link_type ) : ?>
	<a class="tile-link" href="<?php echo ( wp_doing_ajax() ? '#' : esc_url( $url ) ); ?>"<?php echo ( wp_doing_ajax() ? null : $external_target ); ?>>
<?php endif; ?>
	<div class="tile-content">
		<div class="tile-items">
			<?php if ( $head ) : ?>
				<h2><?php echo $head; ?></h2>
			<?php endif; ?>
		<?php echo $content; ?>
		<?php if ( 'none' !== $link_type ) : ?>
			<?php	if ( $btn_bool ) : ?>
			<span class="btn btn-ext"><div class="btn-container"><span><?php echo esc_html( $btn_text ); ?></span><svg role="img" class="symbol" aria-hidden="true" focusable="false"><use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#arrow-ext"></use></svg></div></span>
			<?php	else : ?>
				<span class="btn btn-std"><?php esc_html_e( 'Mehr', 'webwerk-acf-blocks' ); ?></span>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	</div>
<?php if ( $img ) : ?>
	<figure class="wp-block-image">
		<?php echo $img; ?>
	</figure>
<?php endif; ?>
<?php if ( 'none' !== $link_type ) : ?>
</a>
<?php endif; ?>
</div>
