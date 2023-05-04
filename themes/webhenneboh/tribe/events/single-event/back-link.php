<?php
/**
 * Single Event Back link Template Part
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/single-event/back-link.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version 4.7
 *
 */
?>

<?php
$label = esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' );
$events_label_plural = tribe_get_event_label_plural();
?>
<p class="tribe-events-back">

</p>
