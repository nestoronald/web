<?php
require_once('../../../../wp-load.php');

	if ( $_GET['type'] == 'prensa' ) :
		
		$args = array(
			'posts_per_page' 	=> -1,
			'order'				=> 'DESC',
			'orderby'	 		=> 'date',
			'post_type' 		=> 'notas_prensa',
			'post_status' 		=> 'publish',
			'year'  			=> $_GET['year']
		);
				
		//echo '<br>HOLA'.$_GET['year'];
				
		$show_posts = new WP_Query( $args ); 
		
		if ( $show_posts->have_posts() ) :
			while ( $show_posts->have_posts() ) : $show_posts->the_post(); 
				get_template_part( 'content', 'nota' );
			endwhile;			
			wp_reset_postdata();
		else :
						
		endif;
		
	elseif ( $_GET['type'] == 'oportunidades' ) :
	
		$args = array(
			'posts_per_page' 	=> -1,
			'order'				=> 'DESC',
			'orderby'	 		=> 'date',
			'post_type' 		=> 'oportunidades',
			'post_status' 		=> 'publish',
			'year'  			=> $_GET['year']
		);
				
		$show_posts = new WP_Query( $args );
		
		if ( $show_posts->have_posts() ) :
			while ( $show_posts->have_posts() ) : $show_posts->the_post(); 
				get_template_part( 'content', 'blog' );
			endwhile;
			wp_reset_postdata();
		else :
						
		endif;
	
	endif;


?>