<?php
wp_enqueue_script( 'vcard.js', esc_url( plugins_url( 'assets/js/vcard.js', dirname( __DIR__ ) ) ), array( 'jquery' ), false, true );

  // vars
  $additon_position = 'before';
  $image            = get_field( 'img' );
  $size             = 'ww-team'; // (thumbnail, medium, large, full or custom size)
  $firstname        = '';
  $lastname         = '';
  $locality         = '';
  $name_addition    = '';
  $street_address   = '';
  $postal_code      = '';
  $url              = '';
  $name             = '';


  // Bild

if ( $image ) {
	$img = wp_get_attachment_image( $image, $size );
}



// Name
if ( have_rows( 'name' ) ) {
	while ( have_rows( 'name' ) ) {
		the_row();
		$firstname         = get_sub_field( 'firstname' );
		$lastname          = get_sub_field( 'lastname' );
		$name_addition     = get_sub_field( 'name-addition' );
		$addition_position = get_sub_field( 'addition-position' );
	}
}


if ( $addition_position === 'before' ) {
	$name   = $name_addition . ' ' . $firstname . ' ' . $lastname;
	$prefix = $name_addition;
	$suffix = '';
} else {
	$name   = $firstname . ' ' . $lastname . ', ' . $name_addition;
	$prefix = '';
	$suffix = $name_addition;
}
// Anschrift
if ( have_rows( 'postal-address' ) ) {
	while ( have_rows( 'postal-address' ) ) {
		the_row();
		$street_address = get_sub_field( 'street-address' );
		$postal_code    = get_sub_field( 'postal-code' );
		$locality       = get_sub_field( 'locality' );
		// $country = get_sub_field('country-name');
	}
}


  $function     = get_field( 'function' );
  $function_add = get_field( 'function-add' );
  $email        = get_field( 'e-mail' );
  $phone        = get_field( 'phone' );
  $url          = get_field( 'url' );
  // $address = get_field('address');
  $map          = get_field( 'map' );
  $id           = 'hcard-' . strtolower( $firstname . '-' . $lastname );
  $vcard_script = '<script type="text/javascript">
      // With helper methods
      var vCardTeam = vCard.create(vCard.Version.FOUR)
      vCardTeam.addFormattedname("' . $name . '")
      vCardTeam.add(vCard.Entry.NAME, "' . $lastname . ';' . $firstname . ';' . $prefix . ';' . $suffix . '")
      vCardTeam.add(vCard.Entry.TITLE, "' . $function . '")
      vCardTeam.add(vCard.Entry.ORGANIZATION, "")
      vCardTeam.add(vCard.Entry.PHONE, "' . $phone . '", vCard.Type.WORK)
      vCardTeam.addEmail("' . $email . '", vCard.Type.WORK)
      vCardTeam.addAddress("' . $street_address . '", "' . $postal_code . '", "' . $locality . '", "Germany", vCard.Type.WORK)

      var link = vCard.export(vCardTeam, "vCard ' . $firstname . ' ' . $lastname . '", false) // use parameter true to force download
      document.getElementById("' . $id . '").appendChild(link)
  </script>';
?>

<div class="box box-team">
	<figure class="wp-block-image">
		<?php echo $img; ?>
	</figure>
  <div class="t-content" id="<?php echo $id; ?>">
	<?php
	if ( $name !== '' ) {
			wp_add_inline_script( 'vcard.js', $vcard_script );
	}
	?>

  <h3 class="fn"><?php echo $name; ?></h3>
   <!-- Funktion -->
	<?php if ( $function ) : ?>
	<h4 class="function"><?php echo $function; ?></h4>
	<?php endif; ?>
	<?php if ( $function_add ) : ?>
	<p class="function-add"><?php echo $function_add; ?></p>
	<?php endif; ?>
  <!-- Anschrift -->
	<?php if ( $street_address || $locality || $postal_code ) : ?>
	<div translate="no">
	 <address class="adr">
		<?php if ( $street_address ) : ?>
	  <div class="street-address"><?php echo $street_address; ?></div>
		<?php endif; ?>
		<?php if ( $postal_code ) : ?>
		<div class="postal-code"><?php echo $postal_code; ?></div>
		<?php endif; ?>
		<?php if ( $locality ) : ?>
		  <div class="locality"><?php echo $locality; ?></div>
		<?php endif; ?>
  </address>
	</div>
	<?php endif; ?>
	<?php if ( $email || $phone || $url ) : ?>
	<ul class="t-info">
		<?php if ( $email ) : ?>
	  <li class="email"><span class="tadditional">E-Mail:</span> <a href="mailto:<?php echo antispambot( $email ); ?>"><?php echo antispambot( $email ); ?></a></li>
		<?php endif; ?>
		<?php if ( $phone ) : ?>
		<li class="tel"><span class="t-additional">Telefon:</span> <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></li>
		<?php endif; ?>
		<?php if ( $url ) : ?>
		<li class="url"><a href="tel:<?php echo $url; ?>"><?php echo $url; ?></a></li>
		<?php endif; ?>
	</ul>
	<?php endif; ?>
</div>
</div>
