<?php
/**
 * Seiten
 *  Template Name: Team
 * @package Ballbusters
 **/
 wp_enqueue_script( 'buttonghtbox', get_template_directory_uri() . '/js/none.js', array( 'jquery' ), true );
the_post();
get_header();
?>
<main class="main" id="content">

  <?php if (function_exists('nav_breadcrumb')) nav_breadcrumb(); ?>

    <h1>Die Ballbusters</h1>
    <?php the_content(); ?>
    <div class="content-team">

    <?php
    the_category('<h1>','</h1>');
$category_id = $category[0]->term_taxonomy_id;

$category = $category[0]->category_nicename;



$args = array(

  'ballbusters-category'      => 'aktuelle-spieler',
  'posts_per_page' => 100,
  'order' => 'asc',
  'orderby' => ' menu_order'
);
$custom_query = new WP_Query( $args );
if ( $custom_query->have_posts() ) :
  while ( $custom_query->have_posts() ) :
    $custom_query->the_post();
    $category = get_the_category();
    $category = $category[0]->category_nicename;
    ?>

    <!-- <div class="box-drawer"><div class="box-text"></div>
    <span class="box-handle" area-hidden="true"><br>
    <svg role="img" class="symbol" aria-hidden="true" focusable="false"><use xlink:href="' . get_template_directory_uri() . '/img/icons.svg#pfeil-runter"></use></svg></span>
    </div> -->


	<a class="player-item" href="<?php the_permalink(); ?>" >
          <?php
          $media_id  = get_post_thumbnail_id( $post->ID );
          $media_alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
          $caption   = get_the_post_thumbnail_caption( $post->ID );
          if ( $media_id ) {
            echo '<figure>' . get_picture_tag( $media_id, array( 0 => 'ww-team' ), $media_alt ) . '</figure>';
          }

the_title('<h3>','</h3>');  ?>
</a>


<?php endwhile; ?>
<?php endif; ?>


</main>


<?php
get_footer(); ?>
