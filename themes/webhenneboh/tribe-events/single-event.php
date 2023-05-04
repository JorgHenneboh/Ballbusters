<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>
<main class="main" id="content" content="true">
	<div class="wp-block-group section boxblog">
		<div class="wp-block-group__inner-container">
    	<!-- Notices -->
	<?php tribe_the_notices(); ?>


	<div class="single-event">
		<?php echo tribe_event_featured_image( $event_id, 'ww-xlarge', false ); ?>
		<div class="left-event">
		<?php the_title( '<h1>', '</h1>' ); ?>
		<?php if ( tribe_get_cost() ) : ?>
			<span><strong>Eintritt: </strong><?php echo tribe_get_cost( null, true ); ?></span>
		<?php endif; ?>
							<?php if ( tribe_get_start_date( $post, false ) === tribe_get_end_date( $post, false ) ) {
								echo '<p>' . esc_html( tribe_get_start_date( $post, true, 'j. F Y G:i' ) . ' - ' . tribe_get_end_date( $post, true, ' G:i' ) ) . ' Uhr</p>';
					} else {
						echo '<span><strong>Von:</strong>' . esc_html( tribe_get_start_date( $post, true, ' j. F Y' ) ) . ' </span><span><strong>Bis:</strong>' .  esc_html( tribe_get_end_date( $post, true, ' j. F Y' ) ) . '</span>';
					} ?>




		<!-- <?php echo tribe_events_event_schedule_details( $event_id, '<h3>', '</h3>' ); ?> -->


		<p>in <?php echo tribe_get_venue();?></p>
	</div>
		<div class="right-event"><?php	echo tribe_get_embedded_map();?></div>


	<?php
	while ( have_posts() ) :
		the_post();
?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Event featured image, but exclude link -->
			<!-- <?php echo tribe_event_featured_image( $event_id, 'full', false ); ?> -->

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ); ?>
			<div>
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->



<a href="<?php echo esc_url( home_url('/veranstaltungen/') ); ?>" title="Alle Veranstaltungen" class="home">Alle Veranstaltungen</a>




			<!-- Event meta -->

	<?php endwhile; ?>


</div><!-- #tribe-events-content -->
</div></div></div></main>
