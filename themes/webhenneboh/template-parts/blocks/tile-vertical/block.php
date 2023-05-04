<?php
// vars.
$url2 = get_field( 'url2' );
$url1 = get_field( 'url1' );

$image_type = get_field( 'img_type' );
$link_type  = get_field( 'link_type' );
$btn_select = get_field( 'btn_select' );
$btn_style  = get_field( 'btn_style' );
$btn_text   = get_field( 'btn_text' );
$btn_bool   = false;
$img        = false;

if ( ( 'none' !== $link_type ) && ( 'none' !== $btn_select ) ) {
	$btn_bool = true;
}

if ( 'default' === $btn_select ) {
	$btn_text = 'mehr';
}

$size = 'start'; // (thumbnail, medium, large, full or custom size)

if ( 'file' === $image_type ) {
	$image = get_field( 'img_id' );

} elseif ( 'post' === $image_type ) {
	$post_img_id = get_field( 'post_img_id' );
	$image       = get_post_thumbnail_id( $post_img_id );
}

if ( $image ) {
	$img = wp_get_attachment_image( $image, $size );
}

$target = null;

if ( 'internal' === $link_type ) {
	$obj_id = get_field( 'obj_id' );
	$url    = get_permalink( $obj_id );
} elseif ( 'external' === $link_type ) {
	$url             = get_field( 'url' );
	$external_target = ' target="_blank" title="Seite öffnet in neuem Fenster" aria-label="Seite öffnet in neuem Fenster"';
} else {
	$url = '';
}

$head    = get_field( 'title' );
$content = get_field( 'content' );
?>

<div class="box box-tiles<?php echo ( 'none' === $link_type ? ' box-grid' : null ); ?>">

<?php if ( 'none' !== $link_type ) : ?>
	<a class="tile-link box-grid" href="<?php echo ( wp_doing_ajax() ? '#' : esc_url( $url ) ); ?>"<?php echo ( wp_doing_ajax() ? null : $external_target ); ?>>
<?php endif; ?>
<?php if ( $head ) : ?>
	<div class="heading">
<h3><?php echo $head; ?></h3>
	</div>
<?php endif; ?>

		<?php if ( $img ) : ?>
		<figure class="wp-block-image">
		<?php echo $img; ?>
	</figure>
	<?php endif; ?>



		<?php	if ( $content ) : ?>
		<div class="tile-content">
		<?php endif; ?>
	<?php echo $content; ?>


	<?php if ( $content ) : ?>
		</div>
	<?php endif; ?>

	<?php
	if ( $btn_bool ) :
		?>
		<div class="grid-item">
		<?php if ( 'default' === $btn_style ) : ?>
			<span class="btn btn-std"><?php echo esc_html( $btn_text ); ?></span>
		<?php else : ?>
			<button type="button" class="btn-gradient">
				<div class="gradient-bg">
					<span class="gradient-text"><?php echo esc_html( $btn_text ); ?></span>
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/web-werk-launcher-logo.svg" alt="">
				</div>
			</button>
		<?php endif; ?>
	</div>
<?php endif; ?>
<?php if ( 'none' !== $link_type ) : ?>
</a>
<?php endif; ?>
</div>
