<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version  4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

 $blocks = parse_blocks( get_the_content( null, false, get_option( 'page_on_front' ) ) );
foreach ( $blocks as $block ) {
	if ( 'core/cover' === $block['blockName'] ) {
		$content .= '<div class="wp-block-group"><div class="wp-block-group__inner-container">';
		$content .= render_block( $block );
		$content .= '</div></div>';
		break;
	}
}
 echo $content;

	$markup = '<nav class="breadcrumb"><span class="show-for-xxlarge">Sie befinden sich hier: </span><ul id="breadcrumb-menu" itemprop="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><meta itemprop="position" content="1"><a itemprop="item" href="' . get_option( 'home' ) . '"><span itemprop="name">Startseite</span></a></li><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><meta itemprop="position" content="2"><a itemprop="item" href="' . home_url( '/veranstaltungen/' ) . '"><span itemprop="name">Veranstaltungen</span></a></li><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><meta itemprop="position" content="3"><span itemprop="name">' . get_the_title() . '</span></li></ul></nav>';
	the_breadcrumb( $markup );
	$tags = get_the_terms( $post->ID, 'post_tag' );
	$i    = 0;
if ( $tags ) {
	$count = count( $tags );
	if ( 1 === $count ) {
		$tag_content = '<strong class="e-subhead">Thema:</strong> ';
	} elseif ( 1 < $count ) {
		$tag_content = '<strong class="e-subhead">Themen:</strong> ';
	}
	foreach ( $tags as $tag ) {
		$i++;
		if ( 1 < $i ) {
			if ( $i === $count ) {
				$tag_content .= ' und ';
			} else {
				$tag_content .= ', ';
			}
		}
		$tag_content .= esc_html( $tag->name );
	}
}
	$media_id = get_post_thumbnail_id( $post->ID );
	/**
	 *  Returns a string version of the full address of an event
	 *
	 * @param int|WP_Post The post object or post id.
	 *
	 * @return string The event's address.
	 */
function ww_get_full_address( $postId = null ) {
	$address = '';
	if ( tribe_get_venue( $postId ) ) {
		$address .= tribe_get_venue( $postId );
	}

	if ( tribe_get_address( $postId ) ) {
		if ( $address != '' ) {
			$address .= ', ';
		}
		$address .= tribe_get_address( $postId );
	}

	if ( tribe_get_zip( $postId ) ) {
		if ( $address != '' ) {
			$address .= ', ';
		}
		$address .= tribe_get_zip( $postId );
	}

	if ( tribe_get_city( $postId ) ) {
		if ( $address != '' ) {
			$address .= ' ';
		}
		$address .= tribe_get_city( $postId );
	}

	return $address;
}
?>

	 <div class="section">
		 <div class="page-wrap event-single">
		 <div class="e-container">
		 <h1 class="e-head"><?php echo get_the_title(); ?></h1>





<?php


			the_post();
			the_content();
			?>

			 </div>

			 </div>
		 </div>
	 </div>
