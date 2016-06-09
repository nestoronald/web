<?php
// ======================= CUSTOM POST TYPE: TOURS ======================= 
// Create Custom Post Type: Tours
add_action( 'init', 'create_post_type' );
function create_post_type() {
	
	$labels = array(
		'name' 					=> _x('Notas de Prensa', 'post type general name'),
		'singular_name' 		=> _x('Nota de Prensa', 'post type singular name'),
		'add_new' 				=> _x('Agregar nuevo', 'Tour'),
		'add_new_item' 			=> __('Agregar nueva Nota'),
		'edit_item' 			=> __('Editar Nota'),
		'new_item' 				=> __('Nueva Nota'),
		'view_item' 			=> __('Ver Nota'),
		'search_items' 			=> __('Buscar Notas'),
		'not_found' 			=> __('No se encontraron Notas'),
		'not_found_in_trash' 	=> __('No se encontraron Notas en la Papelera'), 
		'parent_item_colon' 	=> '',
		'menu_name' 			=> 'Notas de Prensa'
	);
	
	$args = array(
		'labels' 				=> $labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true, 
		'show_in_menu' 			=> true, 
		'query_var' 			=> true,
		'rewrite' 				=> array('slug' => 'notas-de-prensa', 'with_front' => false),
		'capability_type' 		=> 'post',
		'has_archive' 			=> true, 
		'hierarchical' 			=> false,
		'menu_position' 		=> 20,
		'supports' 				=> array('title','editor','thumbnail','excerpt'),
		'taxonomies'			=> array('post_tag')
	  );
	
	register_post_type('notas_prensa', $args);
}

//add filter to insure the text "Tours", or "Tour", is displayed when user updates a Tour page 
add_filter('post_updated_messages', 'prensa_updated_messages');
function prensa_updated_messages( $messages ) {
	global $post, $post_ID;

  	$messages['book'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Nota actualizada. <a href="%s">Ver Nota</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Nota actualizada.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Nota restaurada a revisi—n desde %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Nota publicada. <a href="%s">Ver Nota</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Nota guardada.'),
		8 => sprintf( __('Nota enviada. <a target="_blank" href="%s">Previsualizar Nota</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Nota programada para: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Previsualizar Nota</a>'),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Borrador de Nota actualizado. <a target="_blank" href="%s">Previsualizar Nota</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

// Add Taxonomies ============

// Destinations labels
/*$destinations_labels = array(
	'name' => _x( 'Destinations', 'taxonomy general name' ),
	'singular_name' => _x( 'Destination', 'taxonomy singular name' ),
	'search_items' =>  __( 'Search Destinations' ),
	'popular_items' => __( 'Popular Destinations' ),
	'all_items' => __( 'All Destinations' ),
	'parent_item' => null,
	'parent_item_colon' => null,
	'edit_item' => __( 'Edit Destination' ), 
	'update_item' => __( 'Update Destination' ),
	'add_new_item' => __( 'Add New Destination' ),
	'new_item_name' => __( 'New Destination Name' ),
	'separate_items_with_commas' => __( 'Separate destinations with commas' ),
	'add_or_remove_items' => __( 'Add or remove Destinations' ),
	'choose_from_most_used' => __( 'Choose from the most used Destinations' ),
	'menu_name' => __( 'Destinations' ),
);

// Activities labels
$activities_labels = array(
	'name' => _x( 'Activities', 'taxonomy general name' ),
	'singular_name' => _x( 'Activity', 'taxonomy singular name' ),
	'search_items' =>  __( 'Search Activities' ),
	'popular_items' => __( 'Popular Activities' ),
	'all_items' => __( 'All Activities' ),
	'parent_item' => null,
	'parent_item_colon' => null,
	'edit_item' => __( 'Edit Activity' ), 
	'update_item' => __( 'Update Activity' ),
	'add_new_item' => __( 'Add New Activity' ),
	'new_item_name' => __( 'New Activity Name' ),
	'separate_items_with_commas' => __( 'Separate activities with commas' ),
	'add_or_remove_items' => __( 'Add or remove Activities' ),
	'choose_from_most_used' => __( 'Choose from the most used Activities' ),
	'menu_name' => __( 'Activities' ),
);

// Type taxonomy
$type_labels = array(
	'name' => _x( 'Type', 'taxonomy general name' ),
	'singular_name' => _x( 'Type', 'taxonomy singular name' ),
	'search_items' =>  __( 'Search Types' ),
	'popular_items' => __( 'Popular Types' ),
	'all_items' => __( 'All Types' ),
	'parent_item' => null,
	'parent_item_colon' => null,
	'edit_item' => __( 'Edit Type' ), 
	'update_item' => __( 'Update Type' ),
	'add_new_item' => __( 'Add New Type' ),
	'new_item_name' => __( 'New Type Name' ),
	'separate_items_with_commas' => __( 'Separate Types with commas' ),
	'add_or_remove_items' => __( 'Add or remove Types' ),
	'choose_from_most_used' => __( 'Choose from the most used Types' ),
	'menu_name' => __( 'Type' ),
);

register_taxonomy("destinations", array('sct_tours', 'sct_itinerary'), array("hierarchical" => false, "labels" => $destinations_labels, "rewrite" => true));
register_taxonomy("activities", "sct_tours", array("hierarchical" => false, "labels" => $activities_labels, "rewrite" => true));
register_taxonomy("type", "sct_tours", array("hierarchical" => false, "labels" => $type_labels, "rewrite" => true));*/

// Custom Fields Data
//add_action("admin_init", "admin_init");
 
function admin_init(){
	add_meta_box("days_meta", "Number of Days", "days_number", "sct_tours", "side", "low");
	add_meta_box("price_meta", "Tour Price", "tour_prices", "sct_tours", "side", "low");
	add_meta_box("sideboxdetails_meta", "Accordion Details", "sidebox_details", "sct_tours", "normal", "low");
	add_meta_box("options_meta", "Other Options", "other_options", "sct_tours", "side", "low");
	add_meta_box("priceoptions_meta", "Price Options", "price_options", "sct_tours", "side", "low");
	add_meta_box("introduction_meta", 'Introduction Text', 'introduction_panel', 'sct_tours', 'normal', 'high' );
}

// Introduction Text
function introduction_panel(){
	global $post;
	$custom = get_post_custom( $post->ID );
	$introduction_text = $custom['introduction_text'][0];
	?>
	<p>
		<textarea cols="40" rows="4" name="introduction_text" style="width:98%;"><?php echo $introduction_text; ?></textarea>
	</p>
	<?php
}

// Multiple prices / options
function price_options(){
	global $post;
	$custom = get_post_custom($post->ID);
	$price_options = unserialize($custom["price_options"][0]);
	$actpriceopt = $custom["actpriceopt"][0];
	?>
	<p>
		<input name="actpriceopt" type="checkbox" id="actpriceopt"<?php echo ($actpriceopt == 'on' ? ' checked="checked"' : ''); ?> />
		<label for="actpriceopt"><?php _e('Activate options', 'seecol'); ?></label>
	</p>
	<ol id="priceopt">
		<?php if (!empty($price_options)): ?>
			<?php foreach($price_options as $key => $price_option): ?>
			<li>
				<input name="price[]" value="<?php echo $price_option['price']; ?>" class="priceinput" /> <a href="#" class="priceopt_delete">x</a>
			</li>
			<?php endforeach; ?>
		<?php else: ?>
			<li>
				<input name="price[]" value="" />
			</li>
		<?php endif; ?>
	</ol>
	<?php
}


// Map Latitude / Longitude
function map_latlng(){
	global $post;
	$custom = get_post_custom($post->ID);
	$latlng = $custom["latlng"][0];
	$zoom = $custom["zoom"][0];
	$markers = $custom["markers"][0];
	?>
	<p><label>Map Latitude/Longitude:</label><br />
	<input name="latlng" value="<?php echo $latlng; ?>" /></p>
	<p><label>Map Zoom:</label><br />
	<input name="zoom" value="<?php echo $zoom; ?>" /></p>
	<p><label>Markers:</label><br />
	<textarea name="markers" rows="6" cols="26"><?php echo $markers; ?></textarea></p>
<?php
}

// Number of Days
function days_number(){
  global $post;
  $custom = get_post_custom($post->ID);
  $days_number = $custom["days_number"][0];
  ?>
  <label>Days:</label>
  <input name="days_number" value="<?php echo $days_number; ?>" />
  <?php
}

// Prices
function tour_prices() {
	global $post;
	$custom = get_post_custom($post->ID);
	$usd = $custom["usd"][0];
	$eur = $custom["eur"][0];
	$gbp = $custom["gbp"][0];
	?>
	<p><label>USD Price:</label><br />
	<input name="usd" value="<?php echo $usd; ?>" /></p>
	<p><label>EUR Price:</label><br />
	<input name="eur" value="<?php echo $eur; ?>" /></p>
	<p><label>GBP Price:</label><br />
	<input name="gbp" value="<?php echo $gbp; ?>" /></p>
	<?php
}

// Other Options
function other_options() {
	global $post;
	$custom = get_post_custom($post->ID);
	$bestseller = $custom["bestseller"][0];
	$tournumber = $custom["tournumber"][0];
	
	if ($bestseller == "true"){
		$acheck = ' checked="checked"';
		$bcheck = '';
	}else{
		$acheck = '';
		$bcheck = ' checked="checked"';
	}
	
	?>
	Best Seller:<br />
	<input type="radio" name="bestseller" id="abest" value="true"<?php echo $acheck; ?> /> <label for="abest">Yes</label><br />
	<input type="radio" name="bestseller" id="bbest" value="false"<?php echo $bcheck; ?> /> <label for="bbest">No</label><br /><br />
	<label for="tournumber">Tour Number:</label><br />
	<input type="text" name="tournumber" value="<?php echo $tournumber; ?>" id="tournumber" />
	<?php
}

// Sidebox Details
function sidebox_details() {
	global $post;
	$custom = get_post_custom($post->ID);
	$destinations = $custom["destinations"][0];
	$highlights = $custom["highlights"][0];
	$activities = $custom["activities"][0];
	$included = $custom["included"][0];
	$notincluded = $custom["notincluded"][0];
	$extra = $custom["extra"][0];
	$hotels = $custom["hotels"][0];
	?>
	<p><label>Destinations:</label><br />
	<textarea cols="50" rows="5" name="destinations"><?php echo $destinations; ?></textarea></p>
	<p><label>Highlights:</label><br />
	<textarea cols="50" rows="5" name="highlights"><?php echo $highlights; ?></textarea></p>
	<p><label>Activities:</label><br />
	<textarea cols="50" rows="5" name="activities"><?php echo $activities; ?></textarea></p>
	<p><label>What's Included:</label><br />
	<textarea cols="50" rows="5" name="included"><?php echo $included; ?></textarea></p>
	<p><label>What's not Included:</label><br />
	<textarea cols="50" rows="5" name="notincluded"><?php echo $notincluded; ?></textarea></p>
	<p><label>Extra Options:</label><br />
	<textarea cols="50" rows="5" name="extra"><?php echo $extra; ?></textarea></p>
	<p><label>Colombia Hotels:</label><br />
	<textarea cols="50" rows="5" name="hotels"><?php echo $hotels; ?></textarea></p>
	<?php
}

//Save Custom Field Data
//add_action('save_post', 'save_details');

function save_details(){
	global $post;
	
	if (get_post_type($post->ID) == "sct_tours"){
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post->ID;
		}
		
		$priceopts = array();
		foreach($_POST['price'] as $key => $value):
			$priceopts[] = array(
				'price' => $value
			);
		endforeach;
		
		if (isset($_POST['actpriceopt'])) update_post_meta($post->ID, 'actpriceopt', 'on');
		else update_post_meta($post->ID, 'actpriceopt', 'off');
		
		update_post_meta($post->ID, 'price_options', $priceopts);
		update_post_meta($post->ID, "days_number", $_POST["days_number"]);
		update_post_meta($post->ID, "usd", $_POST["usd"]);
		update_post_meta($post->ID, "eur", $_POST["eur"]);
		update_post_meta($post->ID, "gbp", $_POST["gbp"]);
		update_post_meta($post->ID, "destinations", $_POST["destinations"]);
		update_post_meta($post->ID, "highlights", $_POST["highlights"]);
		update_post_meta($post->ID, "activities", $_POST["activities"]);
		update_post_meta($post->ID, "included", $_POST["included"]);
		update_post_meta($post->ID, "notincluded", $_POST["notincluded"]);
		update_post_meta($post->ID, "extra", $_POST["extra"]);
		update_post_meta($post->ID, "hotels", $_POST["hotels"]);
		//update_post_meta($post->ID, "latlng", $_POST["latlng"]);
		//update_post_meta($post->ID, "zoom", $_POST["zoom"]);
		//update_post_meta($post->ID, "markers", $_POST["markers"]);
		update_post_meta($post->ID, "bestseller", $_POST["bestseller"]);
		update_post_meta($post->ID, "tournumber", $_POST["tournumber"]);
		update_post_meta($post->ID, 'introduction_text', $_POST['introduction_text']);
	}
	
}

//Add columns to the Tours page list
//add_action("manage_posts_custom_column",  "sct_custom_columns");
//add_filter("manage_edit-sct_tours_columns", "sct_edit_columns");
 
function sct_edit_columns($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Tours Title",
		"destinations" => "Destinations",
		"activities" => "Activities",
		"type" => "Tour Type",
		"price" => "Price USD"
	);
 
	return $columns;
}

function sct_custom_columns($column){
	global $post;
	
	switch ($column) {
		case "price":
			$custom = get_post_custom();
			$actpriceopt = $custom["actpriceopt"][0];
			$price_options = unserialize($custom["price_options"][0]);
			if ($actpriceopt == 'on'){
				foreach($price_options as $key => $option):
					echo 'Option ';
					echo $key + 1 . ': $' . $option['price'] . '<br />';
				endforeach;
			}else
				echo "$" . $custom["usd"][0];
			break;
		case "destinations":
		      echo get_the_term_list($post->ID, 'destinations', '', ', ','');
		      break;
		case "activities":
		      echo get_the_term_list($post->ID, 'activities', '', ', ','');
		      break;
		case "type":
			echo get_the_term_list($post->ID, 'type', '', ', ','');
			break;
	}
}
?>