<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */
?><article id="post-<?php the_ID(); ?>" <?php post_class('grid'); ?>>
		
		<div>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Enlace a %s', 'blakzr' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<p class="entry-excerpt">
				<?php echo get_the_excerpt(); ?> <a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Leer mรกs &rarr;', 'blakzr' ); ?></a>
			</p>
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->
