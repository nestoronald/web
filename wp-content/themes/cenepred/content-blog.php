<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */
?><article id="post-<?php the_ID(); ?>" <?php post_class('blog-list group'); ?>>

        <!--  post de blog-->
        <div class="cont-date">
            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Enlace a %s', 'blakzr' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            <div class="circle-date">
                <?php the_time('d') ?>
            </div>
            </a>
            <div class="month-y">
                <?php the_time('M Y'); ?>
            </div>    
        </div>
        <!-- contenido post de blog-->
        <div class="cont-post">
    		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Enlace a %s', 'blakzr' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
    		<div class="entry-meta">
    			<?php //blakzr_get_author_link(); ?>
    			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Enlace a %s', 'blakzr' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="date-link">
   				</a>
    			<?php // if ( comments_open() && ! post_password_required() ) : ?>
    			<?php // comments_popup_link( __( '0', 'blakzr' ), __( '1', 'blakzr' ), __( '%', 'blakzr' ), 'comment-link' ); ?>
    			<?php //endif; ?>
    		</div>
    
    		<div class="entry-excerpt">
    			<p><?php echo trim( substr( get_the_excerpt(), 0, 259 ) ); ?> <a href="<?php the_permalink(); ?>" class="more-link"><?php _e( ' Ver m&aacute;s', 'blakzr' ); ?></a></p>
    		</div><!-- .entry-excerpt -->
        </div>

	</article><!-- #post-<?php the_ID(); ?> -->
