<div id="youtube-oembed">

<div>
  <?php

  // Load value.
  $iframe = get_field('oembed');

  // Use preg_match to find iframe src.
  preg_match('/src="(.+?)"/', $iframe, $matches);
  $src = $matches[1];

  // Add extra parameters to src and replace HTML.
  $params = array(
      'controls'  => 0,
      'hd'        => 1,
      'autohide'  => 1
  );
  $new_src = add_query_arg($params, $src);
  $iframe = str_replace($src, $new_src, $iframe);

  // Add extra attributes to iframe HTML.
  $attributes = 'frameborder="0"';
  $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

  // Display customized HTML.
  echo $iframe;
  ?>
  <style>
  iframe{
    max-width: 100%;
    height: auto;
  }



  </style>
</div>
<div class="overlay">
  <picture>
  <?php $image = get_field('img');
  $size = 'youtube'; // (thumbnail, medium, large, full or custom size)
  if( $image ) {
      echo wp_get_attachment_image( $image, $size );
  } ?>
  </picture>

		<button data-url="https://www.youtube-nocookie.com/embed/EewD5Hjz4wc?feature=oembed&#038;controls=1&#038;hd=1&#038;rel=0&#038;autohide=1" class="btn-youtube videostart-youtube js-start-youtube">


    <svg role="img" class="symbol" aria-hidden="true" focusable="false"><use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#play"></use></svg>

        </button>

    <div class="webvideo-privacy">
      <?php
      if ( get_field( 'text' ) ) {
      	$privacy = '<p>' . get_field( 'text' ) . '</p>';
      } else {
      	$privacy = '';

      }

      echo 	$privacy;?>
      <input type="checkbox" id="youtube-active-66f256e2db022d5feb7173a7f3344849" class="youtube-active" value="">
      <label for="youtube-active-66f256e2db022d5feb7173a7f3344849">YouTube dauerhaft auf der Site aktivieren</label><br>

      <span>Zur <a href="https://www.elektrorollstuhlsport.de/datenschutz/">Datenschutzerklärung</a></span>
    </div>
</div>

	<!-- <iframe allow="autoplay"></iframe> -->
</div>
