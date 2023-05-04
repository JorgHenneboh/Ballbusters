  <figure class="wp-block-table">
	<table>

  <thead>


		<tr class="pchinfo">
			<th title="Platz"class="platz"><p>Platz</p></th>
			<th title="Mannschaft"class="team"><p>Mannschaft</p></th>
			<th title="Spiele"><p>Spiele</p></th>
			<th title="Gewonnen"  class="guv"><p>G</p></th>
			<th title="Unentschieden" class="guv"><p>U</p></th>
			<th title="Verloren" class="guv"><p>V</p></th>
			<th title="Tore" class="tore"><p>Tore</p></th>
		<th title="Tordifferenz"><p>Diff.</p></th>
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
  <?php
  $gewonnen = trim(get_sub_field( 'gewonnen' ));
  $unentschieden = trim(get_sub_field( 'unentschieden' ));
    $verloren = trim(get_sub_field( 'verloren' ));
  $spiele = (int)$gewonnen + (int)$unentschieden + (int)$verloren;
   ?>
		  <td>

			  <p class="res-tbody"><?php echo $spiele; ?></p>
		  </td>

		  <td class="guv">

			  <p class="res-tbody"><?php echo $gewonnen; ?></p>
		  </td>
		  <td lass="guv">

			  <p class="res-tbody"><?php echo $unentschieden; ?></p>
		  </td>
		  <td lass="guv">

			  <p class="res-tbody"><?php echo $verloren; ?></p>
		  </td>
      <?php

    $tore = trim(get_sub_field( 'tore' ));
    $gegentore = trim(get_sub_field( 'gegentore' ));

    $ergebnis = (int)$tore - (int)$gegentore;
    ?>
              <td class="tore">

                  <p class="res-tbody"><?php echo $tore; ?>:<?php echo $gegentore; ?></p>
              </td>



              <td>

                  <p class="res-tbody"><?php echo $ergebnis; ?></p>

		  </td>
      <?php
$sieg = 3;
$sieg = $gewonnen * $sieg;
$punkte = (int)$sieg + (int)$unentschieden;
       ?>
		  <td>

			  <p class="res-tbody"><?php echo abs($punkte); ?></p>
		  </td>
			  </tr>
		<?php endwhile; ?>

  <?php endif; ?>
</tbody>
</table>

</figure>
