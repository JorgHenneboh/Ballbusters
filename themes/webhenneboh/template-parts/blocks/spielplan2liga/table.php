<figure class="wp-block-table">

  <table class="liga-spielplan">
  <thead>


	<tr>
			<th title="Spiel-Nr."class="spielnummer "><p>Spiel-Nr.</p></th>
			<th title="Zeit"class="time"><p>Zeit</p></th>
			<th title="Spielpaarung"class="spielpaarung"><p>Spielpaarung</p></th>
      <th title="1_schiedsrichter" class="schiedsrichter"><p>1. Schiedsrichter</p></th>
		<th title="2_schiedsrichter" class="schiedsrichter"><p>2. Schiedsrichter</p></th>

		</tr>
	  </thead>
	  <tbody>


  <?php if ( have_rows( 'row' ) ) : ?>



	  <?php
		while ( have_rows( 'row' ) ) :
			the_row();
			?>
		  <tr >

		  <td class="spielnummer">
			  <p class="res-tbody"><?php the_sub_field( 'spielnummer' ); ?></p>
		  </td>
		  <td class="time">

			  <p class="res-tbody"><?php the_sub_field( 'zeit' ); ?></p>&nbsp;<p class="res-tbody">Uhr</p>
		  </td>
		  <td class="spielpaarung">

			  <p class="res-tbody team1"><span><?php the_sub_field( 'mannschaft_1' ); ?></span></p>:


			  <p class="res-tbody team2"><span ><?php the_sub_field( 'mannschaft_2' ); ?></span></p>
		  </td>
      <td class="schiedsrichter">

			  <p class="res-tbody"><?php the_sub_field( '1_schiedsrichter' ); ?></p>
		  </td>
		  <td class="schiedsrichter">

			  <p class="res-tbody"><?php the_sub_field( '2_schiedsrichter' ); ?></p>
		  </td>

			  </tr>
		<?php endwhile; ?>

  <?php endif; ?>
</tbody>
  </table>
</figure>
