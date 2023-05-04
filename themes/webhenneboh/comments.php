<?php
/**
 * Kommentar-Template
 *
 * @package Webwerk
 */

global $postid;
$postid = get_the_ID();

// Get only the approved comments.
$args = array(
	'post_id' => $postid,
	'status'  => 'approve',
);

// The comment Query.
$comments_query = new WP_Comment_Query();
$comments       = $comments_query->query( $args );

// Comment Loop.
if ( $comments ) {

	echo '<h2>Kommentare</h2><div class="comment-items">';

	foreach ( $comments as $comment ) {
		$time_passed     = 0;
		$comment_content = $comment->comment_content;
		$comment_time    = get_comment_time( 'U' );
		$month_names     = array( 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember' );
		$date            = gmdate( 'd. ', $comment_time ) . $month_names[ (int) gmdate( 'n', $comment_time ) - 1 ] . gmdate( ' Y', $comment_time ) . ' um ' . gmdate( 'H:i', $comment_time ) . ' Uhr';
		$dt              = new DateTime( 'now', new DateTimeZone( 'Europe/Berlin' ) );
		$time_passed     = strtotime( $dt->format( 'd.m.Y H:i:s' ) ) - $comment_time;

		if ( $time_passed < 60 ) {
			$time_text = '<abbr title="' . $date . '">vor einigen Sekunden</abbr>';
		} elseif ( $time_passed < 120 ) {
			$time_text = '<abbr title="' . $date . '">vor einer Minute</abbr>';
		} elseif ( $time_passed < 3600 ) {
			$mins      = $time_passed / 60;
			$time_text = '<abbr title="' . $date . '">vor ' . (int) $mins . ' Minuten</abbr>';
		} elseif ( $time_passed < 3600 * 2 ) {
			$time_text = '<abbr title="' . $date . '">vor einer Stunde</abbr>';
		} elseif ( $time_passed < 3600 * 6 ) {
			$hours     = $time_passed / 3600;
			$time_text = '<abbr title="' . $date . '">vor ' . (int) $hours . ' Stunden</abbr>';
		} else {
			$time_text = $date;
		}

		echo '<article class="comment-item">';
		echo '<h3 class="c-author">' . esc_html( get_comment_author() ) . '</h3><p>' . $time_text . '</p><p>' . esc_html( $comment->comment_content ) . '</p>';
		echo '</article>';

	}

	echo '</div>';

}

$args = array(
	'fields'             => array(
		'author'  => '<p class="comment-form-author"><label for="author">Name <span class="required">*</span></label> <input id="author" name="author" type="text" value="" size="30" maxlength="245" required="required" data-cip-id="author"><span class="error" aria-live="polite"></span></p>',
		'email'   => '<p class="comment-form-email"><label for="email">E-Mail <span class="required">*</span></label> <input id="email" name="email" type="text" value="" size="30" maxlength="100" aria-describedby="email-notes" required="required" data-cip-id="email"><span class="error" aria-live="polite"></span></p>',
		'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"> <label for="wp-comment-cookies-consent">Meinen Namen und E-Mail in diesem Browser speichern, bis ich wieder kommentiere.</label></p>',
	),
	'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
	'title_reply_after'  => '</h2>',
	'class_submit'       => 'primary',
	'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
);
comment_form( $args );
