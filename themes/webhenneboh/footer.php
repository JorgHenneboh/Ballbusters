<footer id="footer" class="footer">




	<div class=" footer-nav" aria-label="<?php esc_attr_e( 'Footer-Navigation', 'webwerk' ); ?>">
		<ul id="footer-menu">
			<?php
			if ( has_nav_menu( 'footer-nav' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer-nav',
						'walker'         => new Service_Nav_Walker(),
						'container'      => '',
						'items_wrap'     => '%3$s',
						'depth'          => 1,
					)
				);
			}
			?>
		</ul>
	</div>
<div class="copy">
			<p>&copy; Ballbusters Würzburg <?php echo date( 'Y' ); ?></p>
	</div>

</footer>

<div id="btn-top">
	<a href="#totop" title="<?php esc_attr_e( 'Zum Seitenanfang springen', 'webwerk' ); ?>" role="button" aria-label="
		<?php esc_attr_e( 'Zum Seitenanfang springen', 'webwerk' ); ?>">
		<svg role="img" class="symbol" aria-hidden="true" focusable="false">
			<use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/img/icons.svg#arrow-totop"></use>
		</svg>
	</a>
</div>
<?php wp_footer(); ?>

</body>

</html>
