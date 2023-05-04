<?php $theEmail = get_field('spam'); ?>
E-Mail: <a href="mailto:<?php echo antispambot( $theEmail ) ?>">
<?php echo antispambot( $theEmail ) ?></a>
