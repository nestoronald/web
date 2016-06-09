<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */
?><article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>

		<div class="evento-day">
			<?php
				$custom = get_post_custom();
				$details = array();
				$fecha =  $custom['fecha'][0];
				$dia =  $custom['dia'][0];
				$lugar =  $custom['lugar'][0];
				$file =  $custom['file'][0];
			?>
			<?php echo $dia; ?>
		</div>
		
		<div class="evento-details">
			<h2><?php the_title(); ?></h2>
	
			<div class="nota-excerpt">
				<!-- <p><?php echo trim( substr( get_the_excerpt(), 0, 160 ) ).'.'; ?> <a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Ver m&aacute;s', 'blakzr' ); ?></a></p> -->				
				<ul>
					<?php
					if ( '' != $fecha ) :
					?>
					<li><?php echo $fecha; ?></li>
					<?php
					endif;
					?>
					<?php
					if ( '' != $lugar ) :
					?>
					<li><?php echo $lugar; ?></li>
					<?php
					endif;
					?>
					<?php
					if ( '' != $file ) :
					?>
					<li>Detalles: <a href="<?php echo $file; ?>">Descargar</a></li>
					<?php
					endif;
					?>
				</ul>
			</div><!-- .entry-summary -->
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->
