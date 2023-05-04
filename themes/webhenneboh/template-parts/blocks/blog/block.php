
	<h3><?php the_field( 'headline' ); ?></h3>


  <div class="content-news">

  <?php
	$page = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
	if ( ! $page ) {
		 $page = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
	}
	$posts_per_page = get_option( 'posts_per_page' );
	$args           = array(
		'post_type'      => 'post',
		'paged'          => $page,
		'posts_per_page' => 4,
		'orderby'        => 'date',
	);

	// The query.
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) :
			$the_query->the_post();

			$category = get_the_category();
			$category = $category[0]->category_nicename;

			?>
  <div class="post-item-start  <?php echo esc_html( sanitize_title( $category ) ); ?>">
	<a href="<?php the_permalink(); ?>">

			<?php
			$media_id  = get_post_thumbnail_id( $post->ID );
			$media_alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
			$caption   = get_the_post_thumbnail_caption( $post->ID );
			if ( $media_id ) {
				echo '<figure>' . get_picture_tag( $media_id, array( 0 => 'ww-medium' ), $media_alt ) . '</figure>';
			} else {
				echo '<figure><img class="place-maker" src="' . get_template_directory_uri() . '/img/logofachbereich.png"></figure>';
			}
			?>


		<div class="post-info">    <div class="box-content">
			<?php
			$category   = get_the_category();
			$categoryid = $category[0]->category_nicename;

				  $categoryname = get_the_category();
				  $categoryname = $categoryname[0]->name;
			?>
				  <span class="span"><?php echo esc_html( $categoryname ); ?>&nbsp;|&nbsp;<?php the_time( 'd.m.Y' ); ?></span>

				  <?php
						  $users = get_field( 'user' );
					?>

							<?php
							if ( $users ) :
								?>
						  <span>&nbsp;|&nbsp;von:&nbsp;
								<?php foreach ( $users as $user ) : ?>

									  <?php echo $user->display_name; ?>
							  <?php endforeach; ?>
							</span>

							<?php endif; ?>
		  <br>
						<?php $quelle = get_field( 'quelle' ); ?>


							<?php if ( $quelle ) : ?>
							<span>Quelle:&nbsp;<?php echo $quelle; ?></span>
							<?php endif; ?>





				  <?php the_title( '<h3>', '</h3>' ); ?>
				  <?php echo excerpt( 48 ); ?>
					</div>
 </div>
  </a>
  </div>
		  <?php endwhile; ?>
  <!-- end of the loop -->

  </div>


		<?php
  endif;
	?>
	<?php
	echo '<a class="event-link" href="'.esc_url( home_url( '/aktuelles/' ) ).'">weitere Beiträge</a>';
	 ?>
