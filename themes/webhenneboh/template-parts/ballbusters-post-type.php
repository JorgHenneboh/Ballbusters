<?php
// Register Custom Post Type
function Ballbusters_post_type() {

	// $labels =
	array(
		'name'                  => _x( 'Die Ballbusters', 'Post Type General Name' ),
		'singular_name'         => _x( 'Die Ballbusters', 'Post Type Singular Name' ),
		'menu_name'             => __( 'Die Ballbusters' ),
		'name_admin_bar'        => __( 'Die Ballbusters' ),
		'archives'              => __( 'Ballbusters Archiv' ),
		'attributes'            => __( ' Spieler Attribute' ),
		'parent_item_colon'     => __( 'Eltern Spieler' ),
		'all_items'             => __( 'Alle Spieler' ),
		'add_new_item'          => __( 'Add New Item' ),
		'add_new'               => __( 'Neuen Spieler hinzufügen' ),
		'new_item'              => __( 'Neuer Spieler' ),
		'edit_item'             => __( ' Spieler bearbeiten' ),
		'update_item'           => __( ' Spieler aktualisieren' ),
		'view_item'             => __( ' Spieler ansehen' ),
		'view_items'            => __( ' Spieler ansehen' ),
		'search_items'          => __( ' Spieler suchen' ),
		'not_found'             => __( 'Nicht gefunden' ),
		'not_found_in_trash'    => __( 'Nicht im Papierkorb' ),
		'featured_image'        => __( 'Beitragsbild' ),
		'set_featured_image'    => __( 'Beitragsbild hinzufügen' ),
		'remove_featured_image' => __( 'Beitragsbild entfernen' ),
		'use_featured_image'    => __( 'Als Beitragsbild benutzen' ),
		'insert_into_item'      => __( 'In Spieler einfügen' ),
		'uploaded_to_this_item' => __( 'Zum Spieler hochgeladen' ),
		'items_list'            => __( ' Spielerliste' ),
		'items_list_navigation' => __( ' Spielernavigation' ),
		'filter_items_list'     => __( ' Spieler filtern' ),
	);
	$args   = array(
		'label'               => __( 'Die Ballbusters' ),
		'description'         => __( ' Spieler für Ballbusterss' ),
		// 'labels'              => $labels,
		'show_in_rest'        => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies'          => array( 'Ballbusters-category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-editor-kitchensink',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'dieballbusters', $args );

}
add_action( 'init', 'Ballbusters_post_type', 0 );

// dirname( __FILE__ ) . '/acc-icon.svg'
function ballbusters_my_taxonomy() {

    register_taxonomy(
        'ballbusters-category',
        'dieballbusters',
        array(
            'label' => __( 'Kategorien' ),
            'rewrite' => array( 'slug' => 'ballbusters-category' ),
            'hierarchical' => true,
						'hierarchical'      => true,
						'public'            => true,
						'show_ui'           => true,
						'show_admin_column' => true,
						'show_in_nav_menus' => true,

        )
    );
}
add_action( 'init', 'ballbusters_my_taxonomy' );
