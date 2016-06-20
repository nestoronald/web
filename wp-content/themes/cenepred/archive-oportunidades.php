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
					<?php _e( 'Oportunidades Laborales' ) ?>
				</h1>
			</div>
			
			<?php
				
				$args = array(
					'type'				=> 'yearly',
					'format'			=> 'html', 
					'before'			=> '',
					'after'				=> '',
					'show_post_count'	=> false,
					'echo'				=> 1,
					'order'				=> 'DESC',
					'post_type'			=> 'oportunidades'
				);
				
			?>
			
			<ul class="date-navigation group" data-url="<?php echo get_template_directory_uri(); ?>" data-type="oportunidades">
				<?php wp_get_archives( $args ); ?>
			</ul>
			
			<div class="archive-updater">
			
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'blog' ); ?>

				<?php endwhile; ?>

				<?php blakzr_content_nav( 'nav-below' ); ?>

			<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<h1 class="entry-title"><?php _e( 'No se encontró nada', 'blakzr' ); ?></h1>
				
				<div class="entry-content">
					<p><?php _e( 'Disculpas, pero no se han encontrado resultados para el archivo solicitado. Puede que la búsqueda le ayudará a encontrar una entrada relacionada.', 'blakzr' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

			<?php endif; ?>
			
			<?php
			    // Get years that have posts
			    $years = $wpdb->get_results( "SELECT YEAR(post_date) AS year FROM wp_posts WHERE post_type = 'oportunidades' AND post_status = 'publish' GROUP BY year DESC" );
			
			    //  For each year, do the following
			    /*foreach ( $years as $year ) {
			
			        // Get all posts for the year
			        $posts_this_year = $wpdb->get_results( "SELECT ID, post_title FROM wp_posts WHERE post_type = 'oportunidades' AND post_status = 'publish' AND YEAR(post_date) = '" . $year->year . "'" );
			
			        // Display the year as a header
			        echo '<h2 class="content-title">' . $year->year . '</h2>';
			
			        // Start an unorder list
			        echo '<ul>';
			
			        // For each post for that year, do the following
			        foreach ( $posts_this_year as $post ) {
			            // Display the title as a hyperlinked list item
			            echo '<li><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></li>';
			        }
			
			        // End the unordered list
			        echo '</ul>';
			    }*/
			?>
			</div>
			

		</div><!-- .main-content -->

		<?php get_sidebar(); ?>

	<?php get_footer(); ?>