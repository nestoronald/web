<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */
?><article id="post-<?php the_ID(); ?>" <?php post_class('archive-prensa group'); ?>>

		<figure>
			<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'notas' ); ?></a>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/th-prensa.png" alt="<?php the_title(); ?>"></a>
			<?php endif; ?>
		</figure>
		
		<div class="nota-details">
			<h2 class="nota-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Enlace a %s', 'blakzr' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<div class="entry-meta">
			<?php the_time('d/m/y'); ?>
			</div>
	
			<div class="nota-excerpt">
				<p><?php echo trim( substr( get_the_excerpt(), 0, 160 ) ).'.'; ?> <a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Ver m&aacute;s', 'blakzr' ); ?></a></p>
			</div><!-- .entry-summary -->
		</div>

 </article><!-- #post-<?php the_ID(); ?> -->
