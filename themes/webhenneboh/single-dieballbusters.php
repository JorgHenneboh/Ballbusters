<?php
/**
 * single dieballbusters
 *
 * @package Ballbusters
 **/

/*
 * https://gist.github.com/bramchi/d0767c32a772550486ea
 * Roots.io searchform.php template hack to fix Polylang search
 *
 * Note: Polylang setting 'Hide URL language info for default language' should be enabled for this to work.
 * Soil-nice-search disabled in Roots.
 */
$language_subdir = '';
if ( function_exists( 'pll_current_language' ) ) {
	$current_language = pll_current_language();
	$default_language = pll_default_language();
	if ( $current_language !== $default_language ) {
		$language_subdir = $current_language . '/';
	}
}
?>
<!DOCTYPE html>
<html id="totop" <?php language_attributes(); ?> class="no-js" data-path="<?php echo esc_url( get_template_directory_uri() ); ?>" itemscope itemtype="http://schema.org/WebPage">
<head>

	<meta charset="utf-8">
	<title><?php wp_title(' - ', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	wp_head();
	if ( get_query_var( 'rqsnt' ) || get_query_var( 'cpt' ) || get_query_var( 'rqsnt-contact' ) ) {
			echo '<div class="wp-block-ww-group box head-box"><p>';
		if ( 'n' === get_query_var( 'rqsnt' ) || 'n' === get_query_var( 'rqsnt-contact' ) ) {
			echo esc_html__( 'Leider konnte das Formular nicht abgeschickt werden. Bitte probiere es noch einmal oder melde dich direkt bei uns', 'webwerk' ) . ' <a href="' . esc_url( get_translated_url( '/kontakt/' ) ) . '">' . esc_url( get_translated_url( '/kontakt/' ) ) . '</a>';
		} elseif ( 'y' === get_query_var( 'rqsnt' ) || 'y' === get_query_var( 'rqsnt-contact' ) ) {
			echo esc_html__( 'Vielen Dank für die Kontaktaufnahme! Eine Bestätigungsmail sollte in deinem Postfach sein. Falls nicht, siehe im Spam-Filter nach oder wende dich an', 'webwerk' ) . ' <a href="mailto:' . get_bloginfo( 'admin_email' ) . '">' . get_bloginfo( 'admin_email' ) . '</a>';
		} elseif ( 'n' === get_query_var( 'cpt' ) ) {
			echo esc_html__( 'Eingabefehler - bitte überprüfe alle Felder noch einmal oder melde dich direkt bei uns', 'webwerk' ) . ' <a href="' . esc_url( get_translated_url( '/kontakt/' ) ) . '">' . esc_url( get_translated_url( '/kontakt/' ) ) . '</a>';
		}
			echo '</p></div>';
	}
	?>
</head>

<body class="<?php the_body_class_index( 'main-nav' ); ?>">

	<header>
<nav id="nav_wrap">



		<nav id="ballbusterspage">
			<ul>

		<?php
		if ( has_nav_menu( 'ballbusters-nav' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'ballbusters-nav',
					'walker'         => new Main_Nav_Walker(),
					'container'      => '',
					'items_wrap'     => '%3$s',
					'depth'          => 2,
				)
			);
		}

?>
</ul>
</nav>


</nav>
	</header>

</div>

 <main class="main" id="content" content="true">

	<?php

	$media_id  = get_post_thumbnail_id( $post->ID );
	$media_alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
	$caption   = get_the_post_thumbnail_caption( $post->ID );
	if ( $media_id ) {
		$img = '<figure>' . get_picture_tag( $media_id, array( 0 => 'ww-team' ), $media_alt ) . '</figure>';
	}
	 ?>

<div class="player-description">
	<?php if (function_exists('nav_breadcrumb')) nav_breadcrumb(); ?>
<h1>Ballbusters Spieler <?php the_title(); ?></h1>
<?php echo $img ?>
	   <h3><?php the_field('position'); ?></h3>
	   <?php $theEmail = get_field('mail'); ?>
	   <a href="mailto:<?php echo antispambot( $theEmail ) ?>"><?php echo antispambot( $theEmail ) ?></a>

<?php 	 the_content(); ?>

</div>
</div>

</main>
<?php get_footer(); ?>
