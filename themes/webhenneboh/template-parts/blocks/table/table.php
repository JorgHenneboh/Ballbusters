  <figure id=bundesligatable>
	<table>

  <thead>


		<tr>
			<th title="Platz"class="platz"><p>Platz</p></th>
			<th title="Mannschaft"class="team"><p>Mannschaft</p></th>
			<th title="Spiele" id="bundesliga" ><p>Spiele</p></th>
			<th title="Gewonnen" id="bundesliga" class="guv"><p>G</p></th>
			<th title="Unentschieden" id="bundesliga"  class="guv"><p>U</p></th>
			<th title="Verloren"id="bundesliga" class="guv"><p>V</p></th>
			<th title="Tore" id="bundesliga"  class="tore"><p>Tore</p></th>
		<th title="Tordifferenz" id="bundesliga" ><p>Diff.</p></th>
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

		  <td class="platz">
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
		  <td id="bundesliga">

			  <p class="res-tbody"><?php echo $spiele; ?></p>
		  </td>



		  <td id="bundesliga"  class="guv">

			  <p class="res-tbody"><?php the_sub_field( 'gewonnen' ); ?></p>
		  </td>
		  <td id="bundesliga"  class="guv">

			  <p class="res-tbody"><?php the_sub_field( 'unentschieden' ); ?></p>
		  </td>
		  <td id="bundesliga" class="guv">

			  <p class="res-tbody"><?php the_sub_field( 'verloren' ); ?></p>
		  </td>
      <?php

    $tore = trim(get_sub_field( 'tore' ));
    $gegentore = trim(get_sub_field( 'gegentore' ));

    $ergebnis = (int)$tore - (int)$gegentore;
    ?>
              <td id="bundesliga"  class="tore">

                  <p class="res-tbody"><?php echo $tore; ?>:<?php echo $gegentore; ?></p>
              </td>



              <td id="bundesliga" >

                  <p class="res-tbody"><?php echo $ergebnis; ?></p>

		  </td>
      <?php
$sieg = 2;
$sieg = $gewonnen * $sieg;
$punkte = (int)$sieg + (int)$unentschieden;
       ?>
		  <td class="punkte">

			  <p class="res-tbody"><?php echo abs($punkte); ?></p>
			  </tr>
      </td>
		<?php endwhile; ?>

  <?php endif; ?>
</tbody>
</table>

</figure>
