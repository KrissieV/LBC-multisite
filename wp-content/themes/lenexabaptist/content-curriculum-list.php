<?php
/**
 * @package lenexabaptist
 */
?>

<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
	<span><?php the_field('series'); ?></span>
	<span><?php the_field('publisher'); ?></span>

	

</li><!-- #post-## -->