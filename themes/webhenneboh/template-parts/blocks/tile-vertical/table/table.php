  <figure class="wp-block-table">
	<table class="bundesliga-table">

  <thead>


		<tr class="pchinfo">
			<th title="Platz"class="platz"><p>Platz</p></th>
			<th title="Mannschaft"class="team"><p>Mannschaft</p></th>
			<th title="Spiele"><p>Spiele</p></th>
			<th title="Gewonnen"  class="guv"><p>G</p></th>
			<th title="Unentschieden" class="guv"><p>U</p></th>
			<th title="Verloren" class="guv"><p>V</p></th>
			<th title="Tore" class="tore"><p>Tore</p></th>
		<th title="Tordifferenz"><p>TD</p></th>
	  <th title="Punkte" class="punkte"><p>Punkte</p></th>
		</tr>
	  </thead>
	  <tbody>


  <?php if ( have_rows( 'row' ) ) : ?>



	  <?php
		while ( have_rows( 'row' ) ) :
			the_row();
			?>
		  <tr class="zeile">

		  <td>
			  <p class="res-tbody"><?php the_sub_field( 'platz' ); ?></p>
		  </td>
		  <td class="team">

			  <p class="res-tbody"><?php the_sub_field( 'mannschaft' ); ?></p>
		  </td>
		  <td>

			  <p class="res-tbody"><?php the_sub_field( 'spiele' ); ?></p>
		  </td>
		  <td class="guv">

			  <p class="res-tbody"><?php the_sub_field( 'gewonnen' ); ?></p>
		  </td>
		  <td lass="guv">

			  <p class="res-tbody"><?php the_sub_field( 'unentschieden' ); ?></p>
		  </td>
		  <td lass="guv">

			  <p class="res-tbody"><?php the_sub_field( 'verloren' ); ?></p>
		  </td>
		  <td class="tore">

			  <p class="res-tbody"><?php the_sub_field( 'tore' ); ?></p>
		  </td>



		  <td>

			  <p class="res-tbody"><?php the_sub_field( 'diff' ); ?></p>
		  </td>
		  <td>

			  <p class="res-tbody"><?php the_sub_field( 'punkte' ); ?></p>
		  </td>
			  </tr>
		<?php endwhile; ?>

  <?php endif; ?>
</tbody>
</table>

</figure>
