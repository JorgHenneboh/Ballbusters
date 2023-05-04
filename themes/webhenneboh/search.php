<?php
/**
 * Seiten
 *
 * @package Ballbusters
 **/

get_header();

/*
 * https://gist.github.com/bramchi/d0767c32a772550486ea
 * Roots.io searchform.php template hack to fix Polylang search
 *
 * Note: Polylang setting 'Hide URL language info for default language' should be enabled for this to work.
 * Soil-nice-search disabled in Roots.
 */
$language_subdir = '';
if ( function_exists( 'pll_current_language' ) ) {
	$current_language = pll_current_language();
	$default_language = pll_default_language();
	if ( $current_language !== $default_language ) {
		$language_subdir = $current_language . '/';
	}
}
?>

  <main class="main" id="content" content="true">
	<?php
	// the_post();
	global $breadcrumb;

	$content = '';

	$blocks      = parse_blocks( get_the_content() );
	$block_found = false;
	foreach ( $blocks as $block ) {
		if ( 'core/cover' === $block['blockName'] ) {
			$content    .= '<div class="wp-block-group "><div class="wp-block-group__inner-container">';
			$content    .= render_block( $block );
			$content    .= '</div></div>';
			$block_found = true;
			break;
		}
	}

	if ( ! $block_found ) {
		$blocks_fr = parse_blocks( get_the_content( null, false, get_option( 'page_on_front' ) ) );
		foreach ( $blocks_fr as $block ) {
			if ( 'core/cover' === $block['blockName'] ) {
				$content .= '<div class="wp-block-group "><div class="wp-block-group__inner-container">';
				$content .= render_block( $block );
				$content .= '</div></div>';
				break;
			}
		}
	}
 if (function_exists('nav_breadcrumb')) nav_breadcrumb(); 

	echo $content;
	?>
		<div class="wp-block-group section">
			<div class="wp-block-group__inner-container">

<h1><?php esc_html_e( 'Suche', 'webwerk' ); ?></h1>

<form class="section form global-search-form" action="<?php echo esc_url( home_url( '/' . $language_subdir ) ); ?>" method="get">
	<input class="field" type="text" name="s" placeholder="<?php esc_html_e( 'Suchbegriff eingeben...', 'webwerk' ); ?>" value="<?php echo esc_html( $s ); ?>" />
	<button type="reset" class="btn btn-reset" aria-label="<?php esc_html_e( 'Eingaben löschen', 'webwerk' ); ?>"><span>X</span></button>
	<button type="submit" class="btn btn-submit"><?php esc_html_e( 'Suchen', 'webwerk' ); ?></button>
</form>
<?php
if ( trim( $s ) ) {
	$title = esc_html__( 'Suchergebnisse für', 'webwerk' ) . ' "' . esc_html( $s ) . '"';
} else {
	$title = esc_html__( 'Keine Suchergebnisse', 'webwerk' );
}
echo '<div class="headline"><h2>' . $title . '</h2></div>';
if ( trim( $s ) ) {
	echo '<div class="search-result"><ul>';

	$paged_val      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$posts_per_page = get_option( 'posts_per_page' );
	$offset         = ( $paged_val - 1 ) * $posts_per_page;

	$args = array(
		's'      => $s,
		'offset' => $offset,
		'paged'  => $paged_val,
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		echo '<ul>';
		while ( $query->have_posts() ) {
			$query->the_post();
			echo '<li class="s-item">';
			if ( 'attachment' === get_post_type() ) {
				echo '<a class="result" href="' . esc_url( get_permalink() ) . '" target="blank" title="' . esc_attr__( 'Datei öffnet in einem neuen Fenster', 'webwerk' ) . '">';
			} else {
				echo '<a class="result" href="' . esc_url( get_permalink() ) . '">';
			}
			echo '<h3>';
			the_title();

			echo '</h3>';
			the_excerpt();

			echo '</a></li>';
		}
		echo '</ul>';
		?>
<div class="pagination">
		<?php
		global $wp_query;

		$big = 999999999;
		// need an unlikely integer.

		echo paginate_links(
			array(
				'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'        => '?paged=%#%',
				'current'       => max( 1, get_query_var( 'paged' ) ),
				'total'         => $query->max_num_pages,
				'before_number' => '<span class="screen-reader-text">Seite</span>',
				'prev_text'     => __( '&laquo; Previous' ),
				'next_text'     => __( 'Next &raquo;' ),
				'type'          => 'list',
			)
		);

		?>
</div>
		<?php
	}
	echo '</div>';
}
?>

			</div>
		</div>
</main>
<?php
get_footer();
