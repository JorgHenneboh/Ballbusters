<?php
/**
 * ACF Funktionen.
 *
 * @package webhenneboh
 */

acf_register_block_type(
	array(
		'name'            => 'blog',
		'title'           => __( 'Blog' ),
		'description'     => __( 'A custom blog' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/blog/block.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'testimonial',
		'title'           => __( 'Testimonial' ),
		'description'     => __( 'A custom testimonial block.' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/btn-download/block.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'testimonial',
		'title'           => __( 'Testimonial' ),
		'description'     => __( 'A custom testimonial block.' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/btn-img-link/block.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'spielplan-1liga',
		'title'           => __( 'Ergebnis 1.Bundesliga' ),
		'description'     => __( 'A custom testimonial block.' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/spielplan-1liga/table.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'spielplan-2liga',
		'title'           => __( 'Ergebnis 2.Bundesliga' ),
		'description'     => __( 'A custom testimonial block.' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/spielplan-2liga/table.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'spielplan1liga',
		'title'           => __( 'Spielplan 1.Bundesliga' ),
		'description'     => __( 'A custom testimonial block.' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/spielplan1liga/table.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'spielplan2liga',
		'title'           => __( 'Spielplan 2.Bundesliga' ),
		'description'     => __( 'A custom testimonial block.' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/spielplan2liga/table.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'bundesliga',
		'title'           => __( 'Bundesliga Tabelle' ),
		'description'     => __( 'A custom testimonial block.' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/table/table.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'bundesliga-pcf',
		'title'           => __( 'Bundesliga Tabelle PCF' ),
		'description'     => __( 'A custom testimonial block.' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/table-pcf/table.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'team',
		'title'           => __( 'Team' ),
		'description'     => __( 'A custom testimonial block.' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/team/team.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'event',
		'title'           => __( 'Veranltungen' ),
		'description'     => __( 'A custom testimonial block.' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/event/block.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'spam',
		'title'           => __( 'E-Mail Antispambot' ),
		'description'     => __( 'A custom testimonial block.' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/spam/block.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'tile-vertical-bild',
		'title'           => __( 'Kachel Logo' ),
		'description'     => __( 'A custom testimonial block.' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/tile-vertical-bild/block.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'tile-horizontal-img',
		'title'           => __( 'Kachel horizontal' ),
		'description'     => __( 'A custom testimonial block.' ),
		'render_template' => get_template_directory() . '/template-parts/blocks/tile-horizontal-img/block.php',
	)
);
acf_register_block_type(
	array(
		'name'            => 'btn-download',
		'title'           => 'Download-Button',
		'description'     => '',
		'render_template' => get_template_directory() . '/template-parts/blocks/btn-download/block.php',

	)
);
acf_register_block_type(
	array(
		'name'            => 'youtube',
		'title'           => 'YouTube',
		'description'     => '',
		'render_template' => get_template_directory() . '/template-parts/blocks/youtube/block.php',

	)
);
