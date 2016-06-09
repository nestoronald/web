<?php
// ======================= CUSTOM POST TYPE: TOURS ======================= 
// Create Custom Post Type: Tours
add_action( 'init', 'create_post_type_dispositivos' );
function create_post_type_dispositivos() {
	
	$labels = array(
		'name' 					=> _x('Dispositivos Legales', 'post type general name'),
		'singular_name' 		=> _x('Dispositivo Legal', 'post type singular name'),
		'add_new' 				=> _x('Agregar nuevo', ''),
		'add_new_item' 			=> __('Agregar nuevo Dispositivo Legal'),
		'edit_item' 			=> __('Editar Dispositivo Legal'),
		'new_item' 				=> __('Nuevo Dispositivo Legal'),
		'view_item' 			=> __('Ver Dispositivo Legal'),
		'search_items' 			=> __('Buscar Dispositivo Legal'),
		'not_found' 			=> __('No se encontraron Dispositivos Legales'),
		'not_found_in_trash' 	=> __('No se encontraron Dispositivos Legales en la Papelera'), 
		'parent_item_colon' 	=> '',
		'menu_name' 			=> 'Dispositivos Legales'
	);
	
	$args = array(
		'labels' 				=> $labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true, 
		'show_in_menu' 			=> true, 
		'query_var' 			=> true,
		'rewrite' 				=> array('slug' => 'dispositivos', 'with_front' => false),
		'capability_type' 		=> 'post',
		'has_archive' 			=> true, 
		'hierarchical' 			=> false,
		'menu_position' 		=> 20,
		'supports' 				=> array('title','editor','thumbnail','excerpt'),
		'taxonomies'			=> array('post_tag')
	  );
	
	register_post_type('dispositivos', $args);
}

//add filter to insure the text "Tours", or "Tour", is displayed when user updates a Tour page 
add_filter('post_updated_messages', 'dispositivos_updated_messages');
function dispositivos_updated_messages( $messages ) {
	global $post, $post_ID;

  	$messages['evento'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Dispositivo Legal actualizado. <a href="%s">Ver Dispositivo Legal</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Dispositivo Legal actualizado.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Dispositivo Legal restaurado a revisión desde %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Evento publicado. <a href="%s">Ver Dispositivo Legal</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Evento guardado.'),
		8 => sprintf( __('Evento enviado. <a target="_blank" href="%s">Previsualizar Dispositivo Legal</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Evento programado para: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Previsualizar Dispositivo Legal</a>'),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Borrador de Evento actualizado. <a target="_blank" href="%s">Previsualizar Dispositivo Legal</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

// Add Taxonomies ============

// Mes labels
$tipo_labels = array(
	'name' 							=> _x( 'Tipo', 'taxonomy general name' ),
	'singular_name' 				=> _x( 'Tipo', 'taxonomy singular name' ),
	'search_items' 					=> __( 'Buscar Tipos' ),
	'popular_items' 				=> __( 'Tipos más leídos' ),
	'all_items' 					=> __( 'Todos los Tipos' ),
	'parent_item' 					=> null,
	'parent_item_colon' 			=> null,
	'edit_item' 					=> __( 'Editar Tipo' ), 
	'update_item' 					=> __( 'Actualizar Tipo' ),
	'add_new_item' 					=> __( 'Agregar Tipo' ),
	'new_item_name' 				=> __( 'Nuevo nombre del Tipo' ),
	'separate_items_with_commas' 	=> __( 'Separar Tipos con comas' ),
	'add_or_remove_items' 			=> __( 'Agregar o eliminar Tipos' ),
	'choose_from_most_used' 		=> __( 'Seleccione los Tipos más usados' ),
	'menu_name' 					=> __( 'Tipo' ),
);

register_taxonomy( 'tipo', array('dispositivos', 'normativas'), array('hierarchical' => false, 'labels' => $tipo_labels, 'rewrite' => true));


//Add columns to custom post
add_filter( 'manage_edit-dispositivos_columns', 'dispositivos_edit_columns');
add_action( 'manage_posts_custom_column', 'dispositivos_custom_columns' );
 
function dispositivos_edit_columns($columns){
	$columns = array(
		'cb'			=> '<input type=\"checkbox\" />',
		'title' 		=> 'T&iacute;tulo',
		'tipo' 			=> 'Tipo',
		'date'			=> 'Fecha'
	);
 
	return $columns;
}

function dispositivos_custom_columns($column){
	global $post;
	
	switch ($column) {
		case 'mes' :
		      echo get_the_term_list($post->ID, 'tipo', '', ', ','');
		      break;
	}
}

?>