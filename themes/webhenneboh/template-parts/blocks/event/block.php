


		<h3><?php the_field( 'headline' ); ?></h3>

<div class="content-event">
<?php
	// $vars = filter_input_array(
	// INPUT_POST,
	// array(
	// 'month' => FILTER_SANITIZE_NUMBER_INT,
	// 'cat'   => FILTER_SANITIZE_NUMBER_INT,
	// 'city'  => FILTER_SANITIZE_NUMBER_INT,
	// 'venue' => FILTER_SANITIZE_NUMBER_INT,
	// 'tag'   => FILTER_SANITIZE_NUMBER_INT,
	// )
	// );


if ( ! function_exists( 'ww_get_full_address' ) ) {
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
}

		global $post;
?>

				<?php

					global $post;

				if ( function_exists( 'tribe_get_events' ) ) {
					$events = tribe_get_events(
						array(
							'ends_after'     => 'now',
							'eventDisplay'   => 'list',
							'posts_per_page' => 4,
						)
					);
				}

				if ( $events ) {

					$month         = '';
					$current_month = false;

					foreach ( $events as $post ) {
						setup_postdata( $post );
						$media_id = get_post_thumbnail_id( $post->ID );

						$month = tribe_get_start_date( $post, false, 'F Y' );


						// if ( $media_id ) {
									// $img = '<figure class="wp-block-image"><div class="e-img">' . tribe_event_featured_image( $event_id, 'event-img', false ) . ( $caption ? '</div><figcaption>' . $caption . '</figcaption>' : null ) . '</figure>';
						// }

						// get the current taxonomy term
						$cats = get_the_terms( $term_id, 'tribe_events_cat' );
						foreach ( $cats as $cat ) {
										$image = get_field( 'img', $cat );
										$size  = 'full'; // (thumbnail, medium, large, full or custom size)
							if ( $image ) {
									$image = '<figure id="wp-block-image"><div class="e-img">' . wp_get_attachment_image( $image, $size ) . '</div></figure>';
							}
						}

						if ( $media_id ) {
															$img = '<figure class="wp-block-image"><div class="event-img">' . tribe_event_featured_image( $event_id, 'event-img', false ) .  ( $caption ? '</div><figcaption>' . $caption . '</figcaption>' : null ) . '</figure>';
														}
														else{
														$img =	$image;

														}
						// var_dump($cats);

						echo '<div class="event-item-start"><a class"btn" href="' . esc_url( get_permalink() ) . '">' . $img . '<div class="post-info"><div class="box-content">';
							// $catname = $slug[0] = $cat->name;
							// echo $catname;
						the_title( '<h3>','</h3>' );

						if ( tribe_get_start_date( $post, false ) === tribe_get_end_date( $post, false ) ) {
								echo '<p>' . esc_html( tribe_get_start_date( $post, true, 'j. F Y G:i' ) . ' - ' . tribe_get_end_date( $post, true, ' G:i' ) ) . ' Uhr</p>';
						} else {
							echo '<p>Beginn:' . esc_html( tribe_get_start_date( $post, true, ' j. F Y' ) ) . ' <br>Ende:' . esc_html( tribe_get_end_date( $post, true, ' j. F Y ' ) ) . '</p>';
						}

						if ( tribe_get_the_content() ) {
									echo '<div class="e-teaser"><h3 class="e-subhead">' . esc_html__( 'Beschreibung:', 'webwerk' ) . '</h3><p>' . excerpt( 21 ) . '</p></div>';
						}
						if ( tribe_get_venue() ) {
										echo '<div class="e-venue"><h3 class="e-subhead">' . esc_html__( 'Ort:', 'webwerk' ) . '</h3><p>'.  esc_html(	tribe_get_address())	 . '<br>' . esc_html( tribe_get_zip() ) .' ' .esc_html( tribe_get_city()) . '</p></div>';
						}
						echo '</div></div></a></div>';




					}


					wp_reset_postdata();
				} else {
					echo '<h3>Zur Zeit sind keine Veranstaltungen geplant.</h3>';
				}
				?>
</div>
<?php
echo '<a class="event-link" href="' . esc_url( home_url( '/veranstaltungen/' ) ) . '">weitere Veranstaltungen</a>';
?>
