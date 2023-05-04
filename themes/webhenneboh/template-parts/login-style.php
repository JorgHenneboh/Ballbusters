<?php 
/* Add your custom logo to the login page */

function wpdev_filter_login_head() {

    if ( has_custom_logo() ) :

        $image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
        ?>
        <style type="text/css">
            .login h1 a {
                background-image: url(<?php echo esc_url( $image[0] ); ?>);
                -webkit-background-size: <?php echo absint( $image[1] )?>px;
                background-size: <?php echo absint( $image[1] ) ?>px;
                height: <?php echo absint( $image[2] ) ?>px;
                width: <?php echo absint( $image[1] ) ?>px;
            }
        </style>
        <?php
    endif;
}

add_action( 'login_head', 'wpdev_filter_login_head', 100 );

function new_wp_login_url() {
    return home_url();
}
add_filter('login_headerurl', 'new_wp_login_url');


/* Custom CSS on login */

function my_custom_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/login-style.css' );
}

add_action( 'login_enqueue_scripts', 'my_custom_login_stylesheet' );
