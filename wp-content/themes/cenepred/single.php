<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
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

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				$format = get_post_format();
				if ( false === $format )
					$format = 'standard';

				?>

				<?php get_template_part( 'content', $format ); ?>

				<?php
					//blakzr_get_post_author();
					//blakzr_get_taxonomies();
					//blakzr_get_related_posts();
				?>
				
				<?php comments_template( '', true ); ?>

			<?php endwhile; ?>

		</div><!-- .main-content -->

		<?php get_sidebar(); ?>

	

	<?php get_footer(); ?>

