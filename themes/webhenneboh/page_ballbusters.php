<?php

/**
 * Template Name: Ballbusters
 *
 * @package Ballbusters
 **/
get_header(); ?>

<main class="main" id="content" content="true">


	<?php if (function_exists('nav_breadcrumb')) nav_breadcrumb(); ?>


	 <?php
			the_post();
		?>


<?php
			the_content();
?>



</main>
<?php
get_footer();
