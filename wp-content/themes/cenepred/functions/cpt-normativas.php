<?php
// ======================= CUSTOM POST TYPE: TOURS ======================= 
// Create Custom Post Type: Tours
add_action( 'init', 'create_post_type_gestion' );
function create_post_type_gestion() {
	
	$labels = array(
		'name' 					=> _x('Dirección de Gestion y Procesos', 'post type general name'),
		'singular_name' 		=> _x('Gestión y Procesos', 'post type singular name'),
		'add_new' 				=> _x('Agregar nuevo', ''),
		'add_new_item' 			=> __('Agregar nueva Normativa'),
		'edit_item' 			=> __('Editar Normativa'),
		'new_item' 				=> __('Nueva Normativa'),
		'view_item' 			=> __('Ver Normativa'),
		'search_items' 			=> __('Buscar Normativa'),
		'not_found' 			=> __('No se encontraron Normativas'),
		'not_found_in_trash' 	=> __('No se encontraron Normativas en la Papelera'), 
		'parent_item_colon' 	=> '',
		'menu_name' 			=> 'Normativas y Lineamientos'
	);
	
	$args = array(
		'labels' 				=> $labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true, 
		'show_in_menu' 			=> true, 
		'query_var' 			=> true,
		'rewrite' 				=> array('slug' => 'dgp', 'with_front' => false),
		'capability_type' 		=> 'post',
		'has_archive' 			=> true, 
		'hierarchical' 			=> false,
		'menu_position' 		=> 20,
		'supports' 				=> array('title','editor','thumbnail','excerpt'),
		'taxonomies'			=> array('post_tag')
	  );
	
	register_post_type('normativas', $args);
}

//add filter to insure the text "Tours", or "Tour", is displayed when user updates a Tour page 
add_filter('post_updated_messages', 'normativas_updated_messages');
function normativas_updated_messages( $messages ) {
	global $post, $post_ID;

  	$messages['evento'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Normativa actualizada. <a href="%s">Ver Normativa</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Normativa actualizado.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Normativa restaurado a revisión desde %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Normativa publicada. <a href="%s">Ver Normativa</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Normativa guardada'),
		8 => sprintf( __('Normativa enviada. <a target="_blank" href="%s">Previsualizar Normativa</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Evento programado para: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Previsualizar Normativa</a>'),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Borrador de Normativa actualizada. <a target="_blank" href="%s">Previsualizar Normativa</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}


//Add columns to custom post
add_filter( 'manage_edit-dispositivos_columns', 'normativas_edit_columns');
add_action( 'manage_posts_custom_column', 'normativas_custom_columns' );
 
function normativas_edit_columns($columns){
	$columns = array(
		'cb'			=> '<input type=\"checkbox\" />',
		'title' 		=> 'Título',
		'tipo' 			=> 'Tipo',
		'date'			=> 'Fecha'
	);
 
	return $columns;
}

function normativas_custom_columns($column){
	global $post;
	
	switch ($column) {
		case 'mes' :
		      echo get_the_term_list($post->ID, 'tipo', '', ', ','');
		      break;
	}
}

?>