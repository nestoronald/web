<?php
// ======================= CUSTOM POST TYPE: TOURS ======================= 
// Create Custom Post Type: Tours
add_action( 'init', 'create_post_type_oportunidades' );
function create_post_type_oportunidades() {
	
	$labels = array(
		'name' 					=> _x('Oportunidades Laborales', 'post type general name'),
		'singular_name' 		=> _x('Oportunidad Laboral', 'post type singular name'),
		'add_new' 				=> _x('Agregar nuevo', 'Oportunidad'),
		'add_new_item' 			=> __('Agregar nueva Oportunidad'),
		'edit_item' 			=> __('Editar Oportunidad Laboral'),
		'new_item' 				=> __('Nueva Oportunidad Laboral'),
		'view_item' 			=> __('Ver Oportunidad Laboral'),
		'search_items' 			=> __('Buscar Oportunidad Laboral'),
		'not_found' 			=> __('No se encontraron Oportunidades Laborales'),
		'not_found_in_trash' 	=> __('No se encontraron Oportunidades Laborales en la Papelera'), 
		'parent_item_colon' 	=> '',
		'menu_name' 			=> 'Oportunidades'
	);
	
	$args = array(
		'labels' 				=> $labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true, 
		'show_in_menu' 			=> true, 
		'query_var' 			=> true,
		'rewrite' 				=> array('slug' => 'oportunidades', 'with_front' => false),
		'capability_type' 		=> 'post',
		'has_archive' 			=> true, 
		'hierarchical' 			=> false,
		'menu_position' 		=> 20,
		'supports' 				=> array('title','editor','thumbnail','excerpt'),
		'taxonomies'			=> array('post_tag')
	  );
	
	register_post_type('oportunidades', $args);
}

//add filter to insure the text "Tours", or "Tour", is displayed when user updates a Tour page 
add_filter('post_updated_messages', 'oportunidades_updated_messages');
function oportunidades_updated_messages( $messages ) {
	global $post, $post_ID;

  	$messages['oportunidad'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Oportunidad Laboral actualizada. <a href="%s">Ver Oportunidad Laboral</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Oportunidad Laboral actualizada.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Oportunidad Laboral restaurado a revision desde %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Oportunidad Laboral publicada. <a href="%s">Ver Oportunidad Laboral</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Oportunidad Laboral guardada.'),
		8 => sprintf( __('Oportunidad Laboral enviado. <a target="_blank" href="%s">Previsualizar Oportunidad Laboral</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Oportunidad Laboral programado para: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Previsualizar Oportunidad Laboral</a>'),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Borrador de Oportunidad Laboral actualizado. <a target="_blank" href="%s">Previsualizar Oportunidad Laboral</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}


//Add columns to the Tours page list
/*add_filter( 'manage_edit-eventos_columns', 'eventos_edit_columns');
add_action( 'manage_posts_custom_column', 'eventos_custom_columns' );
 
function eventos_edit_columns($columns){
	$columns = array(
		'cb'			=> '<input type=\"checkbox\" />',
		'title' 		=> 'T&iacute;tulo',
		'mes' 			=> 'Mes',
		'date'			=> 'Fecha'
	);
 
	return $columns;
}

function eventos_custom_columns($column){
	global $post;
	
	switch ($column) {
		case 'mes' :
		      echo get_the_term_list($post->ID, 'mes', '', ', ','');
		      break;
	}
}*/

?>