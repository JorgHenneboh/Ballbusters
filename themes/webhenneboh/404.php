<?php
/**
 * 404
 *
 * @package Webwerk
 */

get_header();
?>
<main class="main" id="content" content="true">
  <?php
	the_post();
	the_hero_content( true, false );
	?>
	  <section class="error-404 not-found section">
				<header class="page-header">
					<h1 class="page-title">Uups! Seite nicht gefunden.</h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p>Hier wurde nichts gefunden. Möchten Sie die Suche verwenden?</p>
          <form class="section form global-search-form" action="<?php echo esc_url( home_url( '/' . $language_subdir ) ); ?>" method="get">
          	<input class="field" type="text" name="s" placeholder="<?php esc_html_e( 'Suchbegriff eingeben...', 'webwerk' ); ?>" value="<?php echo esc_html( $s ); ?>" />
          	<button type="reset" class="btn btn-reset" aria-label="<?php esc_html_e( 'Eingaben löschen', 'webwerk' ); ?>"><span>X</span></button>
          	<button type="submit" class="btn btn-submit"><?php esc_html_e( 'Suchen', 'webwerk' ); ?></button>
          </form>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
	</main>
<?php
get_footer();
