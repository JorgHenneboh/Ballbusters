<?php
/**
 * Block: Event Date Time
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/blocks/event-datetime.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.1
 *
 */

$event_id = get_the_ID();
$event = get_post( $event_id );

/**
 * If a yearless date format should be preferred.
 *
 * By default, this will be true if the event starts and ends in the current year.
 *
 * @since 0.2.5-alpha
 *
 * @param bool    $use_yearless_format
 * @param WP_Post $event
 */
$use_yearless_format = apply_filters( 'tribe_events_event_block_datetime_use_yearless_format',
	(
		tribe_get_start_date( $event_id, false, 'Y' ) === date_i18n( 'Y' )
		&& tribe_get_end_date( $event_id, false, 'Y' ) === date_i18n( 'Y' )
	),
	$event
);

$time_format      = tribe_get_time_format();
$date_format      = tribe_get_date_format( ! $use_yearless_format );
$timezone         = get_post_meta( $event_id, '_EventTimezone', true );
$show_time_zone   = $this->attr( 'showTimeZone' );
$local_start_time = tribe_get_start_date( $event_id, true, Tribe__Date_Utils::DBDATETIMEFORMAT );
$time_zone_label  = $this->attr( 'timeZoneLabel' );

if ( is_null( $show_time_zone ) ) {
	$show_time_zone = tribe_get_option( 'tribe_events_timezones_show_zone', false );
}

if ( is_null( $time_zone_label ) ) {
	$time_zone_label = Tribe__Events__Timezones::is_mode( 'site' ) ? Tribe__Events__Timezones::wp_timezone_abbr( $local_start_time ) : Tribe__Events__Timezones::get_event_timezone_abbr( $event_id );
}

$formatted_start_date = tribe_get_start_date( $event_id, false, $date_format );
$formatted_start_time = tribe_get_start_time( $event_id, $time_format );
$formatted_end_date   = tribe_get_end_date( $event_id, false, $date_format );
$formatted_end_time   = tribe_get_end_time( $event_id, $time_format );
$separator_date       = get_post_meta( $event_id, '_EventDateTimeSeparator', true );
$separator_time       = get_post_meta( $event_id, '_EventTimeRangeSeparator', true );

if ( empty( $separator_time ) ) {
	$separator_time = tribe_get_option( 'timeRangeSeparator', ' - ' );
}
if ( empty( $separator_date ) ) {
	$separator_date = tribe_get_option( 'dateTimeSeparator', ' - ' );
}
?>
					<?php if ( tribe_get_start_date( $post, false ) === tribe_get_end_date( $post, false ) ) {
						echo '<p>' . esc_html( tribe_get_start_date( $post, true, 'j. F Y ' )) . ' </br>';
						echo esc_html( tribe_get_start_date( $post, true, 'G:i' ).' - ' . tribe_get_end_date( $post, true, ' G:i' ) ) . ' Uhr</p>';
			
} else {
				echo '<span><strong>Von:</strong>' . esc_html( tribe_get_start_date( $post, true, ' j. F Y' ) ) . ' </span><span><strong>Bis:</strong>' .  esc_html( tribe_get_end_date( $post, true, ' j. F Y' ) ) . '</span>';
			} ?>


	</h2>
</div>
