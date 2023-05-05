
<div id="sidebar-item">
<?php




$head = get_field( 'title' );
$text = get_field( 'text' );
?>





<?php if ( $head ) : ?>
<div class="headline">
<h3><?php echo $head; ?></h3>
</div>
<?php endif; ?>
<div id="item-logo">


<?php if ( $text ) : ?>
<span><?php echo $text; ?></span>
<?php endif; ?>
		<?php if ( have_rows( 'logos' ) ) : ?>
			<?php
			while ( have_rows( 'logos' ) ) :
				the_row();


				?>

				<?php
				$url         = get_sub_field( 'url' );
				$linkauswahl = get_sub_field( 'linkauswahl' );

				echo '<a href="' . $url . '"' . $linkauswahl . ' >';
				?>



					<?php
						$image = get_sub_field( 'image' );
					if ( $image ) :

						// Image variables.
						$url     = $image['url'];
						$title   = $image['title'];
						$alt     = $image['alt'];
						$caption = $image['caption'];

						// Thumbnail size attributes.
						$size   = 'start';
						$thumb  = $image['sizes'][ $size ];
						$width  = $image['sizes'][ $size . '-width' ];
						$height = $image['sizes'][ $size . '-height' ];

						// Begin caption wrap.
						if ( $caption ) :
							?>
							<div class="wp-caption">
						<?php endif; ?>

							<img src="<?php echo esc_url( $thumb ); ?>" title="<?php echo esc_attr( $title  ); ?>"  alt="<?php echo esc_attr( $alt ); ?>" />

						<?php
						// End caption wrap.
						if ( $caption ) :
							?>
							</div>
						<?php endif; ?>
					<?php endif; ?>

				<?php echo '</a>'; ?>
<?php endwhile; ?>

		<?php endif; ?>
	</div>
</div>
