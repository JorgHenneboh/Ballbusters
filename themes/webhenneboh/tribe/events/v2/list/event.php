<?php
/**
 * View: List Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

$container_classes = [ 'tribe-common-g-row', 'tribe-events-calendar-list__event-row' ];
$container_classes['tribe-events-calendar-list__event-row--featured'] = $event->featured;

$event_classes = tribe_get_post_class( [ 'tribe-events-calendar-list__event', 'tribe-common-g-row', 'tribe-common-g-row--gutters' ], $event->ID );
?>
<div <?php tribe_classes( $container_classes ); ?>>


	<div class="tribe-events-calendar-list__event-wrapper tribe-common-g-col">		
		<a
		href="<?php echo esc_url( $event->permalink ); ?>"
		title="<?php echo esc_attr( $event->title ); ?>"
		rel="bookmark"
		class=""
		>
		<div <?php tribe_classes( $event_classes ) ?>>
			
			<div class="wp-block-columns">
				<div class="wp-block-column">
				<div class="entry-header">		
					<?php $this->template( 'list/event/title', [ 'event' => $event ] ); ?>
					<?php $this->template( 'list/event/date', [ 'event' => $event ] ); ?>			
					<?php  $event_id = get_the_ID(); $event_cats = get_the_terms($event_id, 'tribe_events_cat'); foreach ($event_cats as $category) { echo '<p class="eventkategorie">' . $category->name . '</p>'; } 	?>								
					<?php $this->template( 'list/event/venue', [ 'event' => $event ] ); ?>
											
				</div>
				</div>
				<div class="wp-block-column">
					<?php $this->template( 'list/event/featured-image', [ 'event' => $event ] ); ?>
				</div>						
				<div class="wp-block-column lastone">	
					<?php $this->template( 'list/event/description', [ 'event' => $event ] ); ?>
				</div>	
			</div>	
		
		</div>
		</a>		
	</div>

</div>
