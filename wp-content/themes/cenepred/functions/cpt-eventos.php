<?php
// ======================= CUSTOM POST TYPE: EVENTOS ======================= 
// Create Custom Post Type: Tours
add_action( 'init', 'create_post_type_eventos' );
function create_post_type_eventos() {
	
	$labels = array(
		'name' 					=> _x('Eventos', 'post type general name'),
		'singular_name' 		=> _x('Evento', 'post type singular name'),
		'add_new' 				=> _x('Agregar nuevo', 'Tour'),
		'add_new_item' 			=> __('Agregar nuevo Evento'),
		'edit_item' 			=> __('Editar Evento'),
		'new_item' 				=> __('Nuevo Evento'),
		'view_item' 			=> __('Ver Evento'),
		'search_items' 			=> __('Buscar Eventos'),
		'not_found' 			=> __('No se encontraron Eventos'),
		'not_found_in_trash' 	=> __('No se encontraron Eventos en la Papelera'), 
		'parent_item_colon' 	=> '',
		'menu_name' 			=> 'Eventos'
	);
	
	$args = array(
		'labels' 				=> $labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true, 
		'show_in_menu' 			=> true, 
		'query_var' 			=> true,
		'rewrite' 				=> array('slug' => 'eventos', 'with_front' => false),
		'capability_type' 		=> 'post',
		'has_archive' 			=> true, 
		'hierarchical' 			=> false,
		'menu_position' 		=> 20,
		'supports' 				=> array('title','editor','thumbnail','excerpt'),
		'taxonomies'			=> array('post_tag')
	  );
	
	register_post_type('eventos', $args);
}

//add filter to insure the text "Tours", or "Tour", is displayed when user updates a Tour page 
add_filter('post_updated_messages', 'eventos_updated_messages');
function eventos_updated_messages( $messages ) {
	global $post, $post_ID;

  	$messages['evento'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Evento actualizada. <a href="%s">Ver Evento</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Evento actualizado.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Evento restaurado a revisi—n desde %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Evento publicado. <a href="%s">Ver Evento</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Evento guardado.'),
		8 => sprintf( __('Evento enviado. <a target="_blank" href="%s">Previsualizar Evento</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Evento programado para: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Previsualizar Evento</a>'),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Borrador de Evento actualizado. <a target="_blank" href="%s">Previsualizar Evento</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

// Add Taxonomies ============

// Mes labels
$mes_labels = array(
	'name' 							=> _x( 'Fecha Mes', 'taxonomy general name' ),
	'singular_name' 				=> _x( 'Mes', 'taxonomy singular name' ),
	'search_items' 					=> __( 'Buscar Meses' ),
	'popular_items' 				=> __( 'Meses visitados' ),
	'all_items' 					=> __( 'Todos los meses' ),
	'parent_item' 					=> null,
	'parent_item_colon' 			=> null,
	'edit_item' 					=> __( 'Editar Mes' ), 
	'update_item' 					=> __( 'Actualizar Mes' ),
	'add_new_item' 					=> __( 'Agregar Mes' ),
	'new_item_name' 				=> __( 'Nuevo nombre del Mes' ),
	'separate_items_with_commas' 	=> __( 'Separar meses con comas' ),
	'add_or_remove_items' 			=> __( 'Agregar o eliminar meses' ),
	'choose_from_most_used' 		=> __( 'Seleccione los meses más usados' ),
	'menu_name' 					=> __( 'Mes' ),
);

//register_taxonomy( 'mes', array('eventos'), array('hierarchical' => false, 'labels' => $mes_labels, 'rewrite' => true));
register_taxonomy( 'fecha-mes', array('eventos'), array('hierarchical' => false, 'labels' => $mes_labels, 'rewrite' => true));


//Add columns to the Tours page list
add_filter( 'manage_edit-eventos_columns', 'eventos_edit_columns');
add_action( 'manage_posts_custom_column', 'eventos_custom_columns' );
 
function eventos_edit_columns($columns){
	$columns = array(
		'cb'			=> '<input type=\"checkbox\" />',
		'title' 		=> 'T&iacute;tulo',
		'fecha-mes' 	=> 'Mes',
		'date'			=> 'Fecha'
	);
 
	return $columns;
}

function eventos_custom_columns($column){
	global $post;
	
	switch ($column) {
		case 'fecha-mes' :
		      echo get_the_term_list($post->ID, 'fecha-mes', '', ', ','');
		      break;
	}
}

// Custom Fields Data
add_action( 'admin_init', 'add_post_format_meta_boxes' );
 
function add_post_format_meta_boxes() {
	add_meta_box( 'eventos_details', 'Detalles', 'eventos_detail_panel', 'eventos', 'normal', 'high' );
}

// Introduction Text
function eventos_detail_panel() {
	global $post;
	$custom = get_post_custom( $post->ID );
	$fecha =  $custom['fecha'][0];
	$dia =  $custom['dia'][0];
	$lugar =  $custom['lugar'][0];
	$file =  $custom['file'][0];
	?>
	<table width="100%" class="post-meta-boxes">
		<tr>
			<td width="18%" class="meta-description">
				<label for="eventos_fecha"><strong><?php _e( 'Fecha:', 'blakzr' ); ?></strong></label>
			</td>
			<td width="82%">
				<input type="text" name="eventos_fecha" id="eventos_fecha" value="<?php echo $fecha; ?>">
			</td>
		</tr>
		<tr>
			<td width="18%" class="meta-description">
				<label for="eventos_dia"><strong><?php _e( 'Día:', 'blakzr' ); ?></strong></label>
			</td>
			<td width="82%">
				<input type="text" name="eventos_dia" id="eventos_dia" value="<?php echo $dia; ?>">
			</td>
		</tr>
		<tr>
			<td width="18%" class="meta-description">
				<label for="eventos_lugar"><strong><?php _e( 'Lugar:', 'blakzr' ); ?></strong></label>
			</td>
			<td width="82%">
				<input type="text" name="eventos_lugar" id="eventos_lugar" value="<?php echo $lugar; ?>">
			</td>
		</tr>
		<tr>
			<td width="18%" class="meta-description">
				<label for="eventos_file"><strong><?php _e( 'Detalles (Archivo descargable):', 'blakzr' ); ?></strong></label>
			</td>
			<td width="82%">
				<input type="text" name="eventos_file" id="eventos_file" value="<?php echo $file; ?>">
			</td>
		</tr>
	</table>
	<?php
}

// Save Meta Boxes
add_action( 'save_post', 'save_meta_boxes' );

function save_meta_boxes(){
	global $post;
	
	if ( 'eventos' == get_post_type( $post->ID ) ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post->ID;
		update_post_meta( $post->ID, 'fecha', $_POST['eventos_fecha'] );
		update_post_meta( $post->ID, 'lugar', $_POST['eventos_lugar'] );
		update_post_meta( $post->ID, 'file', $_POST['eventos_file'] );
		update_post_meta( $post->ID, 'dia', $_POST['eventos_dia'] );
	}
}

?>