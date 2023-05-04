<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Display -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.23
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();
?>
<main class="main" id="content" content="true">
	<div class="wp-block-group section ">
		<div class="wp-block-group__inner-container">
	<?php tribe_get_view(); ?>

			</div>
	</div>
</maim>
<?php
get_footer();
