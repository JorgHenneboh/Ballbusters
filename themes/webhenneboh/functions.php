<?php
/**
 * Allgemeine Theme Funktionen
 *
 * @package Webwerk
 **/
require_once 'template-parts/ballbusters-post-type.php';
// ACF.
require_once 'template-parts/acf-definitions.php';
require_once 'template-parts/acf-functions.php';
// Login Style.
require_once 'template-parts/login-style.php';
// // Breadcrumb.
require_once 'template-parts/breadcrumb.php';
// HTML Maker laden.
require_once 'template-parts/html-maker.php';
// Navigations-Funktionen bereitstellen.
require_once 'template-parts/nav-walkers.php';
// Funktionen für responsive Bilder.
require_once 'template-parts/picture-functions.php';
// Funktionen für Hero-Image.
require_once 'template-parts/hero-image.php';
// Mailform.
// require_once 'template-parts/mailform.php';
// Bildgrößen registrieren.
add_image_size( 'youtube', 424, 238, true );
add_image_size( 'contact', 240, 240, true );
add_image_size( 'ww-small', 320, 240, true );
add_image_size( 'ww-medium', 640, 390, true );
add_image_size( 'ww-large', 768, 576, true );
add_image_size( 'ww-xlarge', 1024, 368, true );
add_image_size( 'ww-team', 720, 1080, true );
add_image_size( 'box', 768, 768, true );
add_image_size( 'start', 394, 240, true );
// Beitragsbild aktiveren.
add_theme_support( 'post-thumbnails' );



/**
 * Emoji aus dem header entfernen
 **/
function ww_disable_emoji_dequeue_script() {
	wp_dequeue_script( 'emoji' );
}
add_action( 'wp_print_scripts', 'ww_disable_emoji_dequeue_script', 100 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Registriert die Menüs
 **/
function ww_register_menus() {
	register_nav_menu( 'meta-nav', 'Metanavigation' );
	register_nav_menu( 'bundesliga-nav', 'Bundesliganavigation' );
	register_nav_menu( 'ballbusters-nav', 'Ballbustersnavigation' );
	register_nav_menu( 'social-nav', 'Sozialnavigation' );
	register_nav_menu( 'main-nav', 'Hauptnavigation' );
	register_nav_menu( 'footer-nav', 'Footernavigation' );




}
add_action( 'init', 'ww_register_menus' );

/**
 * Liefert Array mit Datei inklusive Template Pfad und Änderungsdatum.
 *
 * @param array $src Pfad zur Datei innerhalb des WordPress Verzeichnisses.
 */
function get_src_path_uri_version( $src ) {
	$src      = '/' . rtrim( $src, '/' );
	$src_path = get_template_directory() . $src;
	$src_uri  = get_template_directory_uri() . $src;

	if ( file_exists( $src_path ) ) {
		return array(
			'uri'     => $src_uri,
			'version' => filemtime( $src_path ),
		);
	}

	return false;
}

/**
 * Ruft wp_enqueue_script setzt das Änderungsdatum der Datei als Version.
 *
 * @param array $handle    Name des Scripts.
 * @param array $src       Pfad zum Script innerhalb des aktuellen Template Verzeichnisses.
 * @param array $deps      Abhängigkeiten zu anderen Scripts.
 * @param array $in_footer True wenn Script vor /body statt vor /head ausgegeben werden soll, default false.
 */
function enqueue_script_with_timestamp( $handle, $src, $deps = array(), $in_footer = false ) {
	$src = get_src_path_uri_version( $src );

	if ( $src ) {
		wp_enqueue_script( $handle, $src['uri'], $deps, $src['version'], $in_footer );
	}
}

/**
 * Ruft wp_enqueue_style setzt das Änderungsdatum der Datei als Version.
 *
 * @param array $handle Name des Styles.
 * @param array $src    Pfad zum Style innerhalb des aktuellen Template Verzeichnisses.
 * @param array $deps   Abhängigkeiten zu anderen Styles.
 * @param array $media  Medien, für die das Style gedacht ist, default all.
 */
function enqueue_style_with_timestamp( $handle, $src, $deps = array(), $media = 'all' ) {
	$src = get_src_path_uri_version( $src );

	if ( $src ) {
		wp_enqueue_style( $handle, $src['uri'], $deps, $src['version'], $media );
	}
}

/**
 * Lädt Skripte und Styles.
 */
function enqueue_styles_scripts() {

	// WordPress jQuery entfernen.
	wp_deregister_script( 'jquery' );

	// Aktuelles jQuery registrieren.
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), false, true );

	// Aktuelles jQuery laden.
	wp_enqueue_script( 'jquery' );

	// Haupt-Skript laden.
	enqueue_script_with_timestamp( 'ww-script', 'js/app.min.js', array( 'jquery', 'svg4everybody' ), true );

// Haupt-Style laden.

	wp_register_style('style', get_template_directory_uri() . '/css/frontend.min.css', array(), true, );
	wp_enqueue_style('style');

	// SVG-Unterstützung für IE laden.
	wp_enqueue_script( 'svg4everybody', get_template_directory_uri() . '/js/svg4everybody.min.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_styles_scripts' );

/**
 * Setzt die WP SEO Metabox nach unten.
 */
function filter_yoast_seo_metabox() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'filter_yoast_seo_metabox' );

/**
 * Converts permalink into slug.
 *
 * @param string $url Insert permalink.
 */
function ww_get_slug_from_url( $url ) {
	$slug = ( explode( '/', $url, -1 ) );
	return end( $slug );
}

/**
 * Gibt die Farbe der Row zurück.
 *
 * @param string $id ID.
 * @return string Klasse.
 */
function row_color( $id = null ) {
	$row_color = get_field( 'row_color', $id );
	if ( 'none' !== $row_color ) {
		$color = ' ' . $row_color;
		return $color;
	}
}

/**
* SVG freischalten.
*/
// Allow SVG Upload in Media Library
add_filter(
	'wp_check_filetype_and_ext',
	function( $data, $file, $filename, $mimes ) {
		global $wp_version;
		if ( $wp_version !== '5.3' ) {
			return $data;
		}
		$filetype = wp_check_filetype( $filename, $mimes );
		return array(
			'ext'             => $filetype['ext'],
			'type'            => $filetype['type'],
			'proper_filename' => $data['proper_filename'],
		);
	},
	10,
	4
);
function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );
function fix_svg() {
	echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );

/**
 * Add a block category for "Webwerk" if it doesn't exist already.
 *
 * @param array $categories Array of block categories.
 *
 * @return array
 */
function ww_block_categories( $categories ) {
	$category_slugs = wp_list_pluck( $categories, 'slug' );
	return in_array( 'webwerk', $category_slugs, true ) ? $categories : array_merge(
		$categories,
		array(
			array(
				'slug'  => 'webwerk',
				'title' => 'Webwerk',
				'icon'  => null,
			),
		)
	);
}
add_filter( 'block_categories', 'ww_block_categories' );

if ( ! function_exists( 'get_url_from_first_paragraph_block' ) ) {
	function get_url_from_first_paragraph_block( $post ) {
		$external_link = '';
		$blocks        = parse_blocks( $post->post_content );
		foreach ( $blocks as $block ) {
			if ( $block['blockName'] == 'core/paragraph' ) {
				$external_link = $block['innerContent'][0];

				break;
			}
		};
		$external_link = esc_url( wp_strip_all_tags( $external_link ) );
		return $external_link;

	}
}


if ( ! function_exists( 'write_log' ) ) {
	/**
	 * Schreibt individuellen Inhalt nach wp-content/debug.log
	 *
	 * @param misc $log Inhalt zur Ausgabe.
	 **/
	function write_log( $log ) {
		if ( true === WP_DEBUG ) {
			if ( is_array( $log ) || is_object( $log ) ) {
				error_log( print_r( $log, true ) );
			} else {
				error_log( $log );
			}
		}
	}
}
/**
 * Fügt neue Query Variablen hinzu
 *
 * @param  array $vars Query Variablen.
 */
function custom_query_vars_filter( $vars ) {
	$vars[] = 'rqsnt';
	$vars[] = 'rqsnt-contact';
	$vars[] = 'cpt';
	return $vars;
}
add_filter( 'query_vars', 'custom_query_vars_filter' );


class BlockHelper {

	/**
	 * Gets ACF fields for a specific block on a given post
	 *
	 * @author Jens Soegaard <jens@jenssogaard.com>
	 */
	public function getBlockFromPage( string $block_name, int $post_id ) {
		$post = get_post( $post_id );

		if ( ! $post ) {
			return false;
		}

		if ( has_blocks( $post ) ) {
			$blocks = parse_blocks( $post->post_content );
		}

		if ( $blocks ) {
			$search_id = array_search_id( $block_name, $blocks, array() );
			array_pop( $search_id );
			$block_data = $blocks;
			foreach ( $search_id as $path ) {
				$block_data = $block_data[ $path ];
			}

			return $block_data['attrs']['data'];
		}

		return false;
	}

	public function getRepeater( $block, $field, $sub_field ) {
		$repeater = array();
		$no       = $block[ $field ];
		for ( $i = 0; $i < $no; $i++ ) {
			$repeater[] = $block[ $field . '_' . $i . '_' . $sub_field ];
		}
		return $repeater;
	}

	public function getField( $block, $field ) {
		return $block[ $field ];
	}

}

// Function to recursively search for a given value.
function array_search_id( $search_value, $array, $id_path ) {

	if ( is_array( $array ) && count( $array ) > 0 ) {

		foreach ( $array as $key => $value ) {

			$temp_path = $id_path;

			// Adding current key to search path
			array_push( $temp_path, $key );

			// Check if this value is an array
			// with atleast one element
			if ( is_array( $value ) && count( $value ) > 0 ) {
				$res_path = array_search_id(
					$search_value,
					$value,
					$temp_path
				);

				if ( $res_path != null ) {
					return $res_path;
				}
			} elseif ( $value == $search_value ) {
				return $temp_path;
			}
		}
	}

	return null;
}

function serialize_array_comma( $array ) {
	$s = '';
	$c = count( $array );
	$i = 1;

	foreach ( $array as $val ) {
		if ( $i === $c ) {
			$s .= $val;
		} else {
			$s .= $val . ', ';
		}
		$i++;
	}

	return $s;
}
/**
 * Liefert die Body Klassen mit Menü-Index
 *
 * @param string  $menu_position Menü-Position des Hauptmenüs.
 * @param integer $post_id Beitrags-ID optional, Standard aktueller Post.
 */
function get_body_class_index( $menu_position, $post_id = false ) {

	$return    = '';
	$locations = get_nav_menu_locations();

	if ( array_key_exists( $menu_position, $locations ) ) {
		$menu       = wp_get_nav_menu_object( $locations[ $menu_position ] );
		$menu_items = wp_get_nav_menu_items( $menu->term_id );
		$post_id    = $post_id ? $post_id : get_the_ID();

		foreach ( $menu_items as $menu_item ) {
			if ( intval( $menu_item->object_id ) === $post_id ) {
				$return = 'p' . esc_attr( $menu_item->menu_order ) . ' ';
				break;
			}
		}
	}

	$return .= is_front_page() ? 'home' : basename( get_permalink() );

	return $return;

}

/**
 * Gibt die Body Klassen mit Menü-Index aus
 *
 * @param string  $menu_position Menü-Position des Hauptmenüs.
 * @param integer $post_id Beitrags-ID optional, Standard aktueller Post.
 */
function the_body_class_index( $menu_position, $post_id = false ) {

		echo esc_attr( get_body_class_index( $menu_position, $post_id = false ) );

}
/**
 * Kurzinhalt individuelle Wortanzahl
 *
 * @param  integer $limit Wortanzahl.
 */
function excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( ' ', $excerpt ) . '...';
	} else {
		$excerpt = implode( ' ', $excerpt );
	}
	$excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );
	return $excerpt;
}

/**
 * Returns cover block at first, then all other blocks; additional breadcrumb.
 *
 * @param  boolean $breadcrumb Optional.
 * @param  boolean $show_content Optional.
 * @param  boolean $only_content Optional.
 * @return string              Content.
 */
function get_hero_content( $breadcrumb = true, $show_content = true, $only_content = false ) {
	global $post;

	$content = '';

	$blocks = parse_blocks( get_the_content() );
	foreach ( $blocks as $block ) {
		if ( 'core/cover' === $block['blockName'] && ! $only_content ) {
			$content    .= '<div class="wp-block-group "><div class="wp-block-group__inner-container">';
			$content    .= render_block( $block );
			$content    .= '</div></div>';
			$block_found = true;
			break;
		} else {
			$block_found = false;
		}
	}

	if ( ! $block_found ) {
		$blocks_fr = parse_blocks( get_the_content( null, false, get_option( 'page_on_front' ) ) );
		foreach ( $blocks_fr as $block ) {
			if ( 'core/cover' === $block['blockName'] && ! $only_content ) {
				$content .= '<div class="wp-block-group "><div class="wp-block-group__inner-container">';
				$content .= render_block( $block );
				$content .= '</div></div>';
				break;
			}
		}
	}



	if ( $show_content ) {

		$content_markup = '';
		foreach ( $blocks as $block ) {
			if ( ( 'core/cover' === $block['blockName'] && ! $only_content ) || ( 'core/group' === $block['blockName'] && ! count( $block['innerBlocks'] ) ) ) { // sort out empty group blocks as well
				continue;
			} else {
				// var_dump($block);
				$content_markup .= render_block( $block );
			}
		}

		// Remove wpautop filter so we do not get paragraphs for two line breaks in the content.
		$priority = has_filter( 'the_content', 'wpautop' );
		if ( false !== $priority ) {
			remove_filter( 'the_content', 'wpautop', $priority );
		}

		$content .= apply_filters( 'the_content', $content_markup );

		if ( false !== $priority ) {
			add_filter( 'the_content', 'wpautop', $priority );
		}
	}

	return $content;
}



/**
 * Returns translated URL if Polylang is activated.
 *
 * @param  string $slug Slug.
 * @return string       Permalink.
 */
function get_translated_url( $slug ) {
	if ( function_exists( 'pll_current_language' ) ) {
		$post_id            = url_to_postid( home_url( $slug ) );
		$current_lang       = pll_current_language( 'slug' );
		$translated_post_id = pll_get_post( $post_id, $current_lang );
		$permalink          = get_permalink( $translated_post_id );
	} else {
		$permalink = home_url( $slug );
	}
	return $permalink;
}

/**
 * Entfernt das Feld Website vom Kommentar.
 *
 * @param  array $fields Felder.
 * @return array         Felder.
 */
function remove_website_field( $fields ) {
	unset( $fields['url'] );
	return $fields;
}
add_filter( 'comment_form_default_fields', 'remove_website_field' );

/**
 * Returns human readable filesize.
 *
 * @param  integer $bytes    Byte.
 * @param  integer $decimals Decimals.
 * @return string            Filesize with suffix.
 */
function human_filesize( $bytes, $decimals = 2 ) {
	$factor = floor( ( strlen( $bytes ) - 1 ) / 3 );
	if ( $factor > 0 ) {
		$sz = 'KMGT';
	}
	return sprintf( "%.{$decimals}f", $bytes / pow( 1024, $factor ) ) . ' ' . @$sz[ $factor - 1 ] . 'B';
}

// Remove JQuery migrate

function remove_jquery_migrate( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			// Check whether the script has any dependencies

			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );
function wpcodex_hide_email_shortcode( $atts, $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}

	return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
}

add_shortcode( 'email', 'wpcodex_hide_email_shortcode' );
