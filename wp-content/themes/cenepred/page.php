<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
           <div class="site-location">
        		    <?php the_post(); ?>
        			<h1 class="location-title"><?php the_title(); ?></h1>
 		   </div>

			<article>
			
				<!--<div class="entry-meta">
					< ?php //blakzr_get_author_link(); ?>
					< ?php if ( comments_open() && ! post_password_required() ) : ?>
					< ?php comments_popup_link( __( '0', 'blakzr' ), __( '1', 'blakzr' ), __( '%', 'blakzr' ), 'comment-link' ); ?>
					< ?php endif; ?>
				</div>-->

				<div class="entry-content">
					<?php the_content( __( 'Continúe leyendo <span class="meta-nav">&rarr;</span>', 'blakzr' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Páginas:', 'blakzr' ) . '</span>', 'after' => '</div>' ) ); ?>
					<?php edit_post_link( __( 'Edite esta página', 'blakzr' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-content -->
			</article>
			   
			<?php //comments_template( '', true ); ?>

		</div><!-- .main-content -->

		<?php get_sidebar(); ?>

	<!-- </div> de main wapper el final esta en el footer -->

	<?php get_footer(); ?>
