<?php
/**
 * Functions
 *
 * @package WebWerk Datenschutz
 **/

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
			'page_title' => 'Datenschutz-Einstellungen',
			'menu_title' => 'Datenschutz-Einstellungen',
			'menu_slug'  => 'privacy-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);

}

/**
 * Prints out the privacy settings HTML code and adds the JS.
 */
function ww_privacy_code() {
	$matomo_act                 = get_field( 'ww_privacy_matomo_act', 'option' );
	$matomo_code                = get_field( 'ww_privacy_matomo_code', 'option' );
	$youtube_act                = get_field( 'ww_privacy_youtube_act', 'option' );
	$fts_act                    = get_field( 'ww_privacy_fts_act', 'option' );
	$settings_text              = get_field( 'ww_privacy_settings_text', 'option' );
	$settings_imprint_url       = get_field( 'ww_privacy_settings_imprint_url', 'option' );
	$settings_privacy_url       = get_field( 'ww_privacy_settings_privacy_url', 'option' );
	$settings_accessibility_url = get_field( 'ww_privacy_settings_accessibility_url', 'option' );

	$js = '$(document).ready(function() {
	if (!hasCookieSplitVal("ww-cookies", "closed")) {
		showModal("#content", "#webwerk-cookiesOverlay", "#webwerk-cookies");
	}
	if (hasCookieSplitVal("ww-cookies", "matomo")) {
		$("#matomo-allowed").prop("checked", true);
		matomo_allowed = true;
	}
	if (hasCookieSplitVal("ww-cookies", "youtube")) {
		$("#youtube-allowed").prop("checked", true);
	}
	if (hasCookieSplitVal("ww-cookies", "fts")) {
		$("#fts-allowed").prop("checked", true);
	}
  $("#webwerk-cookies").keydown(function(event) {
      trapTabKey($(this), event);
  });
});

	var matomo_allowed = false;
	if (!hasCookieSplitVal("ww-cookies", "closed")) {
		showModal("#content", "#webwerk-cookiesOverlay", "#webwerk-cookies");
	}
	if (hasCookieSplitVal("ww-cookies", "matomo")) {
		$("#matomo-allowed").prop("checked", true);
		matomo_allowed = true;
	}
	if (hasCookieSplitVal("ww-cookies", "youtube")) {
		$("#youtube-allowed").prop("checked", true);
	}
	if (hasCookieSplitVal("ww-cookies", "fts")) {
		$("#fts-allowed").prop("checked", true);
	}
	$("#save-csettings").click(function() {
		if ($("#matomo-allowed").prop("checked") == true) {
			addCookieSplitVal("ww-cookies", "matomo", 30);
			matomo_allowed = true;
		} else {
			removeCookieSplitVal("ww-cookies", "matomo", 30);
			matomo_allowed = false;
		}
		if ($("#youtube-allowed").prop("checked") == true) {
			addCookieSplitVal("ww-cookies", "youtube", 30);
		} else {
			removeCookieSplitVal("ww-cookies", "youtube", 30);
		}
		if ($("#fts-allowed").prop("checked") == true) {
			addCookieSplitVal("ww-cookies", "fts", 30);
		} else {
			removeCookieSplitVal("ww-cookies", "fts", 30);
		}
		addCookieSplitVal("ww-cookies", "closed", 30);
		hideModal("#content", "#webwerk-cookiesOverlay", "#webwerk-cookies");
	});
	$(".accept-csettings").click(function() {
		' . ( ( $matomo_act && $matomo_code ) ? 'addCookieSplitVal("ww-cookies", "matomo", 30); $("#matomo-allowed").prop("checked", true);' : null ) . '
		' . ( $youtube_act ? 'addCookieSplitVal("ww-cookies", "youtube", 30); $("#youtube-allowed").prop("checked", true);' : null ) . '
		' . ( $fts_act ? 'addCookieSplitVal("ww-cookies", "fts", 30); $("#fts-allowed").prop("checked", true);' : null ) . '
		addCookieSplitVal("ww-cookies", "closed", 30);
		hideModal("#content", "#webwerk-cookiesOverlay", "#webwerk-cookies");
	});
	$("a[href=\'#cookie-settings\']").click(function() {
		showModal("#content", "#webwerk-cookiesOverlay", "#webwerk-cookies");
	});
	$("#set-csettings").click(function() {
			$(this).attr("aria-expanded", true);
			$(".set-options").show();
			$(".basic-cbtns").hide();
		});
	$(".toggle-details").click(function() {
		var id = $(this);
		var detailsid = $("#" + $(this).attr("aria-controls"));
		if (detailsid.hasClass("c-open")) {
			$(".set-options").find(".c-details").slideUp("fast");
			$(".c-open").removeClass("c-open");
			id.attr("aria-expanded", false);
		} else {
			$(".set-options").find(".c-details").slideUp("fast");
			detailsid.addClass("c-open");
			detailsid.slideDown("fast");
			id.attr("aria-expanded", true);
		}
	});';

	$html = '<div id="webwerk-cookies" aria-modal="true"><div class="cookies-container"><section><p>' . ( $settings_text ? $settings_text : 'Wir setzen Cookies auf den Internetseiten des ' . esc_html( get_bloginfo( 'name' ) ) . ' ein. Einige davon sind für den Betrieb der Website notwendig. Andere helfen uns, Ihnen ein verbessertes Informationsangebot zu bieten. Da uns Datenschutz sehr wichtig ist, entscheiden Sie bitte selbst über den Umfang des Einsatzes bei Ihrem Besuch. Stimmen Sie entweder dem Einsatz aller von uns eingesetzten Cookies zu oder wählen Ihre individuelle Einstellung. Vielen Dank und viel Spaß beim Besuch unserer Website!' ) . '</p></section>';

	$html .= '<div class="basic-cbtns"><button id="set-csettings" class="btn btn-cookie" aria-controls="set-options-toggle" aria-expanded="false">Einstellungen anpassen</button>';
	$html .= '<button class="btn btn-cookie accept-csettings">Alle bestätigen</button></div>';

	$html .= '<div class="set-options" id="set-options-toggle">';
	$html .= '<ul class="nav-cookie">';
	$html .= '<li class="c-container">';
	$html .= '<div class="c-input">';
	$html .= '<input type="checkbox" id="necessary-allowed" checked disabled><label for="necessary-allowed">Notwendig</label>';
	$html .= '</div>';
	$html .= '<button type="button" class="toggle-details" id="acc-fts-necessary" aria-controls="fts-necessary" aria-expanded="false"><span>Details</span></button>';
	$html .= '<div class="c-details" id="fts-necessary" aria-labelledby="acc-fts-necessary" role="region">';
	$html .= '<p>Diese Cookies sind für den reibungslosen Betrieb der Website notwendig. Z. B. werden dort Ihre hier getroffenen Cookie-Einstellungen gespeichert.</p>';
	$html .= get_cookie_infos(
		array(
			array(
				'name'        => 'ww-cookies',
				'purpose'     => 'Speichert die Datenschutz-Einstellungen des Besuchers, die in der Cookie-Hinweisbox ausgewählt wurden.',
				'validity'    => '30 Tage',
				'provider'    => 'Eigentümer der Website (keine Übermittlung an Drittanbieter)',
				'privacy_url' => $settings_privacy_url,
			),
		)
	);

	$html .= '</div>';
	$html .= '</li>';

	if ( $fts_act ) {
		$html .= '<li class="c-container">';
		$html .= '<div class="c-input">';
		$html .= '<input type="checkbox" id="fts-allowed"><label for="fts-allowed">Feed Them Social</label>';
		$html .= '</div>';
		$html .= '<button type="button" class="toggle-details" id="acc-fts-details" aria-controls="fts-details" aria-expanded="false"><span>Details</span></button>';
		$html .= '<div class="c-details" id="fts-details" aria-labelledby="acc-fts-details" role="region">';
		$html .= '<p>Von Feed Them Social werden keine Cookies gespeichert.</p>';
		$html .= '</div>';
		$html .= '</li>';
	}

	if ( $youtube_act ) {
		$html .= '<li class="c-container">';
		$html .= '<div class="c-input">';
		$html .= '<input type="checkbox" id="youtube-allowed"><label for="youtube-allowed">YouTube</label>';
		$html .= '</div>';
		$html .= '<button type="button" class="toggle-details" id="acc-youtube-details" aria-controls="youtube-details" aria-expanded="false"><span>Details</span></button>';
		$html .= '<div class="c-details" id="youtube-details" aria-labelledby="acc-youtube-details" role="region">';
		$html .= '<p>Von YouTube werden keine Cookies gespeichert.</p>';
		$html .= '</div>';
		$html .= '</li>';
	}

	if ( $matomo_act && $matomo_code ) {
		$html .= '<li class="c-container">';
		$html .= '<div class="c-input">';
		$html .= '<input type="checkbox" id="matomo-allowed"><label for="matomo-allowed">Statistik</label>';
		$html .= '</div>';
		$html .= '<button type="button" class="toggle-details" id="acc-matomo-details" aria-controls="matomo-details" aria-expanded="false"><span>Details</span></button>';
		$html .= '<div class="c-details" id="matomo-details" aria-labelledby="acc-matomo-details" role="region">';
		$html .= '<p>Statistische Erfassung anonymisierter Nutzerdaten.</p>';
		$html .= get_cookie_infos(
			array(
				array(
					'name'        => '_pk_testcookie',
					'purpose'     => 'Prüft ob der Browser des Benutzers überhaupt Cookies speichert.',
					'validity'    => 'wird unmittelbar wieder gelöscht',
					'provider'    => 'Eigentümer der Website (keine Übermittlung an Drittanbieter)',
					'privacy_url' => $settings_privacy_url,
				),
				array(
					'name'        => '_pk_id',
					'purpose'     => 'Generiert statistische Daten wie der Benutzer die Website benutzt.',
					'validity'    => '13 Monate',
					'provider'    => 'Eigentümer der Website (keine Übermittlung an Drittanbieter)',
					'privacy_url' => $settings_privacy_url,
				),
				array(
					'name'        => '_pk_ref',
					'purpose'     => 'Speichert über welche Vorgänger-Website der Benutzer auf die Website gekommen ist.',
					'validity'    => '6 Monate',
					'provider'    => 'Eigentümer der Website (keine Übermittlung an Drittanbieter)',
					'privacy_url' => $settings_privacy_url,
				),
				array(
					'name'        => '_pk_ses, _pk_cvar, _pk_hsr',
					'purpose'     => 'Speichert temporär statistische Daten für den aktuellen Besuch des Benutzers auf der Website.',
					'validity'    => '30 Minuten',
					'provider'    => 'Eigentümer der Website (keine Übermittlung an Drittanbieter)',
					'privacy_url' => $settings_privacy_url,
				),
			)
		);
		$html .= '</div>';
		$html .= '</li>';

		$js_m = preg_replace( array( '/(.*)<script(.*?)>/ms', '/<\/script>(.*)/ms', '/\/\*.*\*\//ms' ), array( '', '', "_paq.push(['requireConsent']);" ), $matomo_code );
		$js  .= str_replace(
			"_paq.push(['trackPageView']);",
			"if ( matomo_allowed ) {
		_paq.push(['setConsentGiven']);
		}
		_paq.push(['trackPageView']);",
			$js_m
		);
	}

	$html .= '</ul>';
	$html .= '<div class="extended-cbtns"><button id="save-csettings" class="btn btn-cookie">Auswahl bestätigen</button>';
	$html .= '<button class="btn btn-cookie accept-csettings">Alle bestätigen</button></div>';
	$html .= '</div>';

	if ( $settings_imprint_url && $settings_privacy_url ) {
		$html .= '<nav class="cookie-links"><ul>
		<li><a href="' . $settings_imprint_url . '">Impressum</a></li>
		<li><a href="' . $settings_privacy_url . '">Datenschutzerklärung</a></li>
		' . ( $settings_accessibility_url ? '<li><a href="' . $settings_accessibility_url . '">Erklärung zur Barrierefreiheit</a></li>' : null ) . '
		</ul></nav>';
	}

		$html .= '</div>';
		$html .= '</div>';

	if ( $matomo_act || $youtube_act ) {
		echo $html;
		wp_add_inline_script( 'ww-script', $js );
	}
}
	add_action( 'ww_cookie_banner', 'ww_privacy_code' );

/**
 * Returns cookie information from an array.
 *
 * @param  array $infos cookie information.
 * @return string       cookie information.
 */
function get_cookie_infos( $infos ) {
	$output   = '';
	$validity = '';
	foreach ( $infos as $info ) {
		$n = '';
		if ( 0 < strpos( $info['name'], ',' ) ) {
			$n = 'n';
		}
		$output .= '<span>Cookie-Name' . $n . ': ' . $info['name'] . '</span>';
		$output .= '<p>Zweck: ' . $info['purpose'] . '<br>';
		if ( 0 === $info['validity'] ) {
			$validity = 'Browsersitzung (Session)';
		} else {
			$validity = $info['validity'];
		}
		$output .= 'Cookie-Gültigkeit: ' . $validity . '<br>';
		$output .= 'Anbieter: ' . $info['provider'] . '<br>';
		$output .= 'Datenschutz: <a href="' . $info['privacy_url'] . '">' . $info['privacy_url'] . '</a></p>';
	}
	return $output;
}
