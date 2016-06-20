<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */


get_header('home'); ?>

	<div class="main wrap grid">

		<div class="main-content col-8-12">
		
			<nav class="breadcrumbs">
				<?php
				// Code to display breadcrumbs from the plugin 'Breadcrumbs NavXT'
				if ( function_exists( 'bcn_display' ) ) :
					bcn_display();
				endif;
				?>
			</nav>
		
			<div class="site-location">
				<h1 class="location-title">
					<?php _e('Eventos CENEPRED', 'blakzr'); ?>
				</h1>
			</div>
			
			<?php
			
			$meses = get_terms( 'fecha-mes', array(
				'orderby'    => 'id',
				'order'		 => 'ASC',
				'hide_empty' => true
			));

			foreach ( $meses as $mes ) :
			
				?>
				
				<h2 class="content-title"><?php echo $mes->name; ?></h2>
				
				<?php
				
				$args = array(
					'posts_per_page' 	=> -1,
					'order'				=> 'DESC',
					'orderby'	 		=> 'date',
					'post_type' 		=> 'eventos',
					'fecha-mes'			=> $mes->slug,
					'post_status' 		=> 'publish'
				);
				
				$show_posts = new WP_Query( $args );
			
				if ( $show_posts->have_posts() ) :
					while ( $show_posts->have_posts() ) : $show_posts->the_post(); ?>
					<?php get_template_part( 'content', 'evento' ); ?>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					
				<?php endif; ?>
			<?php
			endforeach;
			
			?>

		</div><!-- .main-content -->

		<?php get_sidebar(); ?>

	<?php get_footer(); ?>