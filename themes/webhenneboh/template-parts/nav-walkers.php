<?php
/**
 * Navigations-Funktionen
 *
 * @package Webwerk
 **/

class Simple_Nav_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$output .= sprintf(
			'<li><a href="' . ( ! is_front_page() ? get_home_url() : null ) . '#%s">%s</a>',
			ww_get_slug_from_url( $item->url ),
			$item->title
		);
	}
}
class pcf_pch_Nav_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$actual_depth = $args->depth;
		$has_sub      = is_array( $item->classes ) && in_array( 'menu-item-has-children', $item->classes, true );
		$subhead      = get_field( 'menu-subhead', $item );
		$output      .= sprintf(
			'<li class="%s%s%s" ><a href="%s"%s>%s%s</a>',
			( $item->current ? 'active current ' : ( $item->current_item_ancestor ? 'active ' : null ) ),
			( $has_sub && $actual_depth > 1 ) ? 'pcf_pch-sub ' : null,
			'm' . $item->object_id,
			$item->url,
			( $has_sub && $actual_depth > 1 ) ? ' aria-controls="sub-menu" aria-expanded="false" aria-haspopup="true"' : null,
			$depth === 1 ?  $item->title : $item->title,
			$subhead ? '<span class="submenu-content">' . $subhead . '</span>' : null
		);
	}
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 0 === $depth ) {
			$output .= '<div class="sub-menu-container"><ul id="sub-menu" class="sub-menu">';
		} else {
			$output .= '<ul>';
		}
	}
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 0 === $depth ) {
			$output .= '</ul></div>';
		} else {
			$output .= '</ul>';
		}
	}
}
class Main_Nav_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$actual_depth = $args->depth;
		$has_sub      = is_array( $item->classes ) && in_array( 'menu-item-has-children', $item->classes, true );
		$subhead      = get_field( 'menu-subhead', $item );
		$output      .= sprintf(
			'<li class="%s%s%s"><a href="%s"%s>%s%s</a>',
			( $item->current ? 'active current ' : ( $item->current_item_ancestor ? 'active ' : null ) ),
			( $has_sub && $actual_depth > 1 ) ? 'has-sub ' : null,
			'm' . $item->object_id,
			$item->url,
			( $has_sub && $actual_depth > 1 ) ? 'class="sub" aria-controls="sub-menu" aria-expanded="false" aria-haspopup="true"' : null,
			$depth === 1 ?  $item->title : $item->title,
			$subhead ? '<span class="submenu-content">' . $subhead . '</span>' : null
		);
	}
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 0 === $depth ) {
			$output .= '<div class="sub-menu-container"><ul id="sub-menu" class="sub-menu">';
		} else {
			$output .= '<ul>';
		}
	}
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 0 === $depth ) {
			$output .= '</ul></div>';
		} else {
			$output .= '</ul>';
		}
	}
}

class Meta_Nav_Walker extends Walker {

	private function get_label( $title ) {
		$names = array(
			'Suche'   => 'search',
			'Kontakt' => 'contact',
		);

		if ( isset( $names[ $title ] ) ) {
			$return = $names[ $title ];
		} else {
			$return = sanitize_title( $title );
		}

		return $return;
	}

	private function get_aria_label( $title ) {
		$names = array(
			'Suche' => 'Suche starten',
		);

		if ( isset( $names[ $title ] ) ) {
			$return = $names[ $title ];
		} else {
			$return = $title;
		}

		$return = ' aria-label="' . $return . '"';

		// if ( 'Suche' === $title ) {
		// 	$return .= ' role="button"';
		// }

		return $return;
	}

	public function walk( $elements, $max_depth, ...$args ) {
		$list = array();
		foreach ( $elements as $item ) {
			if ( 'Suche' === $item->title ) {
				$list[] = '<li><a href="' . $item->url . '" class="meta-' . $this->get_label( $item->title ) . '" title="' . $item->title . '"' . $this->get_aria_label( $item->title ) . '><span class="icon-container"><svg role="img" class="symbol" aria-hidden="true" focusable="false"><use xlink:href="' . esc_url( get_template_directory_uri() ) . '/img/icons.svg#' . $this->get_label( $item->title ) . '"></use></svg></span><span class="link-text">' . $item->title . '</span></a></li>';
			} else {
				$list[] = '<li><a href="' . $item->url . '" class="meta-' . $this->get_label( $item->title ) . '" title="' . $item->title . '"' . $this->get_aria_label( $item->title ) . '><span class="icon-container"><svg role="img" class="symbol" aria-hidden="true" focusable="false"><use xlink:href="' . esc_url( get_template_directory_uri() ) . '/img/icons.svg#' . $this->get_label( $item->title ) . '"></use></svg></span><span class="link-text">' . $item->title . '</span></a></li>';
			}
		}
			return join( $list );
	}
}


class Social_Nav_Walker extends Walker {

	public function walk( $elements, $max_depth, ...$args ) {
		$list = array();
		foreach ( $elements as $item ) {
			$list[] = '<li class="' . sanitize_title( $item->title ) . '"><a href="' . $item->url . '" target="_blank" title="' . $item->title . '">
			<svg role="img" class="symbol" aria-hidden="true" focusable="false"><use xlink:href="' . esc_url( get_template_directory_uri() ) . '/img/icons.svg#' . sanitize_title( $item->title ) . '"></use></svg><span>' . $item->title . '</span></a></li>';
		}
			return join( $list );
	}
}
class verband_Nav_Walker extends Walker {

	public function walk( $elements, $max_depth, ...$args ) {
		$list = array();
		foreach ( $elements as $item ) {
			$list[] = '<li class="' . sanitize_title( $item->title ) . '"><a href="' . $item->url . '" target="_blank" title="' . $item->title . '">
			<svg role="img" class="symbol" aria-hidden="true" focusable="false"><use xlink:href="' . esc_url( get_template_directory_uri() ) . '/img/icons.svg#' . sanitize_title( $item->title ) . '"></use></svg><span>' . $item->title . '</span></a></li>';
		}
			return join( $list );
	}
}


class Service_Nav_Walker extends Walker {
	public function walk( $elements, $max_depth, ...$args ) {
		$list = array();
		foreach ( $elements as $item ) {
				$list[] = '<li><a href="' . $item->url . '"' . ( $item->target ? ' target="_blank"' : '' ) . '>' . $item->title . '</a></li>';
		}
		return join( $list );
	}
}

// class Category_Nav_Walker extends Walker {
// 	public function walk( $elements, $max_depth, ...$args ) {
// 		$list          = array();
// 		$category      = get_the_category();
// 		$category0slug = null;
// 		if ( $category ) {
// 			$category0slug = $category[0]->slug;
// 		}
// 		$slug = ww_get_slug_from_url( get_the_permalink() );
// 		foreach ( $elements as $item ) {
// 			$list[] = '<li class="' . sanitize_title( $item->title ) . ( ( sanitize_title( $item->title ) === $category0slug ) || ( 'artikel' === $slug ) ? ' active' : null ) . '"><a href="' . $item->url . '">' . $item->title . '</a></li>';
// 			$slug   = '';
// 		}
// 		return join( $list );
// 	}
// }
class Category_Nav_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		//leerzeichen und punkt  entfernen
		$title = strtolower( str_replace( ' ', '', $item->title ) );
		$titles = strtolower( str_replace( '.', '', $title ) );


		$output .= sprintf(
			'<li class="%s"><a href="%s" %s title="' . $item->title . '" >%s</a>',
			strtolower( str_replace( '&', '', $titles ) ),
			$item->url,
			null,
			'<svg role="img" class="symbol" aria-hidden="true" focusable="false"><use xlink:href="' . get_template_directory_uri() . '/img/icons.svg#' . ww_get_slug_from_url( $item->url ) . '"></use></svg><span>' . $item->title . '</span>'
		);
	}
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}
