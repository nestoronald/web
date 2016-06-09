<?php
/**
 * @package Conveyor
 * @version 1.1.3
 */

/*
Plugin Name:  Conveyor
Plugin URI:   http://makedo.in
Description:  Provides a custom post type, and a range of options for showing content rotators and carousels.
Author:       Matt Watson (Make Do)
Version:      1.1.3
Author URI:   http://mwatson.co.uk
Licence:      GPLv2 or later
License URI:  http://www.gnu.org/licenses/gpl-2.0.html


/////////  VERSION HISTORY

1.0.0	First development version
1.0.1 	Implemented link chooser
1.0.2 	Added Bootstrap Render
1.0.3 	Added Boostrap Version Picker
1.1.0 	Added support for taxonomies
1.1.1 	Added page-attributes to custom post type
1.1.2 	Changed Post Submission
1.1.3 	Fixed featured image

/////////  CURRENT FUNCTIONALITY

- Create conveyor custom post type
- Create conveyor group custom taxonomy
- Add link chooser custom meta box
- Converyor loop query

/////////  DEV STRUCTURE

1 - Admin functions
2 - Loop Query Args
3 - Bootstrap Render
4 - TODO: Foundation Render

*/

//// 1 //// Admin functions

require_once 'conveyor-admin-functions.php';


//// 2 //// Loop Query Args

/**
 * 
 * @since  		1.0.2
 * @updated 	1.1.0
 * 
 * Return loop query args
 *
 * @param 		array 		$args 		argumens to define filter	
 * @return 		array 		arguments to filter wp_query
 * 
 */
function conveyor_query_arguements( $args = array() ) 
{
	$defaults = array(

		'featured'					=> false, 							// [ true | false ] - Set to true to return posts that have the featured post custom meta data set to true
		'featured_post_meta_key' 	=> '_conveyor_featured',			// The custom meta field that identifies the featured post, will also accept an array
		'order'						=> 'ASC',							// [ ASC | DESC ]
		'orderby'					=> 'date', 							// [ date | menu_order ]
		'posts_per_page'			=> 5,								// Set number of posts to return, -1 will return all
		'post_type'					=> 'conveyor_slides',				// [ post | page | custom post type | array() ]			
		'taxonomy_filter'			=> false,							// [ true | false ] - Set to true to filter by taxonomy
		'taxonomy_key'				=> 'conveyor_group',				// The key of the taxonomy we wish to filter by
		'taxonomy_terms'			=> 'conveyor-group-1'				// The terms (uses slug), will accept a string or array
	);

	$return_args					= array();
	$r 								= array_merge( $defaults, $args );
	$meta_query_args				= array(
										'relation' 		=> 'AND',
										array(
											'key' 		=> '_thumbnail_id'
										)
									);
	$tax_query_args 				= null;

	if( $r['featured'] )
	{
		if( is_array( $r['featured_post_meta_key'] ) )
		{
			foreach( $r['featured_post_meta_key'] as $featured_post_meta_key )
			{
				$query = array(
					'key' 		=> $featured_post_meta_key,
		 			'value' 	=> true,
		 			'compare' 	=> '='
				);

				array_push( $meta_query_args, $query );
			}
		}
		elseif( is_string( $r['featured_post_meta_key'] ) )
		{
			$query = array(
				'key' 		=> $r['featured_post_meta_key'],
	 			'value' 	=> true,
	 			'compare' 	=> '='
			);

			array_push( $meta_query_args, $query );
		}
	}

	if( $r['taxonomy_filter'] )
	{
		$tax_query_args = array(
			'taxonomy' 	=> $r['taxonomy_key'],
			'field' 	=> 'slug',
			'terms' 	=> $r['taxonomy_terms']
		);
	}

	$return_args = 	array(
						'post_type'			=> $r['post_type'],
						'orderby'			=> $r['orderby'],
						'order'				=> $r['order'],
						'posts_per_page'	=> $r['posts_per_page'],
						'meta_query' 		=> $meta_query_args,
						'tax_query' 		=> array( $tax_query_args )
					);

	return $return_args;
}



//// 3 //// Bootstrap Render

/**
 * 
 * @since  		1.0.3
 * 
 * Render bootstrap carousel
 * 
 */
function conveyor_render_boostrap( $args = array(), $version = '3' )
{
	// Future proofing, set the version of the carousel we wish to render
	// if( $version == '3' ){ // Render here }
	
	conveyor_render_boostrap_3( $args );
}

/**
 * 
 * @since  		1.0.2
 * @updated 	1.0.3
 * 
 * Render bootstrap 3 carousel
 * 
 */
function conveyor_render_boostrap_3( $args = array() )
{

	$defaults = array(

		'featured'					=> false,
		'featured_post_meta_key' 	=> '_conveyor_featured',
		'id'						=> 'conveyor_carousel',					// If you want to have multiple carousels, you will want to change the id each time
		'images_as_links'			=> true, 								// [ true | false ] - Set to true to wrap images with links (if _conveyor_link set on post)
		'order'						=> 'ASC',
		'orderby'					=> 'date',
		'posts_per_page'			=> 5,
		'post_type'					=> 'conveyor_slides',
		'render_captions'			=> true, 								// [ true | false ] - Set to true to render captions when excerpt is not empty
		'render_controls'			=> true,								// [ true | false ] - Show the slide left right controls
		'render_indicators'			=> true 								// [ true | false ] - Show the slide indicators
	);

	$r 								= array_merge( $defaults, $args );
	$query_args 					= conveyor_query_arguements( $r );
	$posts 							= get_posts( $query_args );

	if( is_array( $posts ) && count( $posts ) > 0 )
	{
		?>
			<div id="<?php echo $r['id']; ?>" class="carousel slide" data-ride="carousel">
				
				<?php

					if( $r['render_indicators'] )
					{
						?>
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<?php
								for ($i = 0; $i < count( $posts ); $i++) 
								{
									?>
										<li data-target="#<?php echo $r['id']; ?>" data-slide-to="<?php echo $i; ?>"<?php echo ( $i == 0 ) ? ' class="active"' : '';?>></li>
									<?php
								}
							?>
						</ol>
						<?php
					}
				?>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">

					<?php

						$i = 0;

						foreach( $posts as $slide )
						{
							$conveyor_link_value 		= get_post_meta( $slide->ID, '_conveyor_link', true );
							$conveyor_open_new_window 	= get_post_meta( $slide->ID, '_conveyor_open_new_window', true );
							?>
								
								<div class="item<?php echo ( $i == 0 ) ? ' active' : '';?>">
									<?php

										if( $r['images_as_links'] && !empty( $conveyor_link_value  ) )
										{
											?>
												<a href="<?php echo $conveyor_link_value; ?>"<?php echo ( $conveyor_open_new_window == true ) ? ' target="_blank"' : ''; ?>><?php echo get_the_post_thumbnail( $slide->ID, 'full' ); ?></a>
											<?php
										}
										else
										{
											echo get_the_post_thumbnail( $slide->ID, 'full' ); 
										}

										if( $r['render_captions'] && !empty( $slide->post_excerpt ) )
										{
											?>
												<div class="carousel-caption">
													<h3><?php echo $slide->post_title; ?></h3>
													<p><?php echo $slide->post_excerpt; ?></p>
												</div>
											<?php
										}
									?>
								</div>

							<?php
							$i++;
						}

					?>

				</div>

				<?php
				if( $r['render_controls'] )
				{
					?>
					<!-- Controls -->
					<a class="left carousel-control" href="#<?php echo $r['id']; ?>" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#<?php echo $r['id']; ?>" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
					<?php
				}
				?>

			</div>
		<?php
	}

	wp_reset_query();
	wp_reset_postdata();
}
?>