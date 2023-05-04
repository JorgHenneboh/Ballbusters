<?php
$file       = get_field( 'file' );
$accessible = get_field( 'accessible' );
$acc_state  = null;
$acc_text   = null;
if ( ! $accessible ) {
	$acc_state = esc_html__( 'nicht', 'webwerk-acf-blocks' );
}
$subtype = $file['subtype'];

if ( strpos( $subtype, 'word' ) ) {
	$filetype = 'word';
	$ft_read  = 'Word';
} elseif ( strpos( $subtype, 'excel' ) || strpos( $subtype, 'spreadsheet' ) ) {
	$filetype = 'excel';
	$ft_read  = 'Excel';
} elseif ( strpos( $subtype, 'presentation' ) || strpos( $subtype, 'powerpoint' ) ) {
	$filetype = 'powerpoint';
	$ft_read  = 'PowerPoint';
} elseif ( 'pdf' === $subtype ) {
	$filetype = 'pdf';
	$ft_read  = 'PDF';
	$acc_text = ', ' . $acc_state . ' ' . esc_html__( 'barrierefrei', 'webwerk-acf-blocks' );
} elseif ( 'zip' === $subtype ) {
	$filetype = 'archive';
	$ft_read  = 'ZIP';
} elseif ( 'image' === substr( $file['mime_type'], 0, 5 ) ) {
	$filetype = 'image';
	$ft_read  = 'Bild';
} else {
	$filetype = 'file';
	$ft_read  = 'Datei';
}

$fileinfo = ' (' . $ft_read . ', ' . human_filesize( $file['filesize'], 0 ) . $acc_text . ')';
?>

<a href="<?php echo ( wp_doing_ajax() ? '#' : esc_url( $file['url'] ) ); ?>" class="btn btn-download" target="_blank" role="button" aria-label="<?php echo esc_attr( $fileinfo ); ?> runterladen"><span class="d-label"><?php echo esc_html( get_field( 'title' ) );?></span><span class="d-additional"><?php echo esc_attr( $fileinfo ); ?></span><svg role="img" class="symbol" aria-hidden="true" focusable="false"><use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#<?php echo esc_attr( $filetype ); ?>"></use></svg></a>
