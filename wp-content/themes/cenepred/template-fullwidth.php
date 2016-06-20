<?php
/**
 * Template Name: Full Width
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */

get_header('home'); ?>

	<div class="site-location">
		<div class="wrapper group">
			<?php the_post(); ?>
			<h1 class="location-title"><?php the_title(); ?></h1>
		</div>
	</div>

	<div class="main wrapper">

		<div class="main-content">

			<nav class="breadcrumbs">
				<?php
				// Code to display breadcrumbs from the plugin 'Breadcrumbs NavXT'
				if ( function_exists( 'bcn_display' ) ) :
					bcn_display();
				endif;
				?>
			</nav>

			<article>

				<div class="entry-content">
					<?php the_content( __( 'Continúe leyendo <span class="meta-nav">&rarr;</span>', 'blakzr' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Páginas:', 'blakzr' ) . '</span>', 'after' => '</div>' ) ); ?>
					<?php edit_post_link( __( 'Edite esta página', 'blakzr' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-content -->
			</article>
			   
			<?php comments_template( '', true ); ?>

		</div><!-- .main-content -->

	</div>

	<?php get_footer(); ?>