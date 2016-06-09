<?php

/***********************************/
/************* WIDGETS *************/
/***********************************/

/***** Sidebars *****/

/* First Widget Area */
$args = array(
	"name"			=> __( 'Sidebar Principal', 'blakzr' ),
	"id"			=> "first-sidebar",
	"description"	=> __('Sidebar principal del sitio', 'blakzr'),
	'before_title'	=> '<h4 class="widgettitle">',
	'after_title'   => '</h4>'
);
if (function_exists('register_sidebar')) register_sidebar($args);

/* Footer Widget Area */
$args = array(
	"name"			=> __( 'Footer', 'blakzr' ),
	"id"			=> "footer-sidebar",
	"description"	=> __('Área de Widgets para el Footer', 'blakzr'),
	'before_title'	=> '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
	'before_widget' => '<li id="%1$s" class="widget col-2-6 %2$s">',
);
if (function_exists('register_sidebar')) register_sidebar($args);

/***** Widgets *****/

/*****************************************/
/********** Widget: Tweets **********/
/*****************************************/

class widget_show_tweets extends WP_Widget {
	function widget_show_tweets() {
		$widget_options = array( 'description' => __( 'Show your Twitter stream', 'blakzr' ), 'classname' => 'tweets' );
		parent::WP_Widget( false, $name = 'Custom - Tweets', $widget_options );	
	}
	
	function widget( $args, $instance ) {		
	    extract( $args );
		$title = empty( $instance[ 'title' ] ) ? __( 'Latest Tweets', 'blakzr' ) : apply_filters( 'widget_title', $instance[ 'title' ] );
		$username = empty( $instance[ 'username' ] ) ? '@twitter' : apply_filters( 'widget_username', $instance[ 'username' ] );
		$tweets_number = empty( $instance[ 'tweets_number' ] ) ? 3 : apply_filters( 'widget_tweets_number', $instance[ 'tweets_number' ] );
		$retweet = empty( $instance[ 'retweet' ] ) ? 'false' : esc_attr( $instance[ 'retweet' ] );
	    ?>
	    	<?php echo $before_widget; ?>
				<?php
				echo $before_title . $title . $after_title;
				
				if ( substr( $username, 0, 1 ) == '@' ) {
					$username = explode( "@", $username );
					$username = $username[1];
				}
				
				// Patterns and Replace strings
				$patterns = array();
				$replace = array();
				$patterns[0] = '@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@';
				$patterns[1] = '/(^|\s)@(\w+)/';
				$patterns[2] = '/(^|\s)#(\w+)/';
				$replace[0] = '<a href="\1" target="_blank">\1</a>';
				$replace[1] = '\1@<a href="http://twitter.com/\2" target="_blank">\2</a>';
				$replace[2] = '\1<a href="http://twitter.com/#!/search?q=%23\2" target="_blank">#\2</a>';
				
				// Set or Get transient
				$transient_name = 'blakzr_widget_tweets' . $this->number;
				$tweets = get_transient( $transient_name );
								
				if ( false === $tweets ) :
					$data_url = 'http://api.twitter.com/1/statuses/user_timeline.json?screen_name=' . $username . '&count=' . $tweets_number . '&include_rts=' . $retweet;
					$tweets_data = wp_remote_retrieve_body( wp_remote_get( $data_url ) );
					
					if ( is_wp_error( $tweets_data ) ) :
						_e( "Tweets can't be loaded", 'blakzr' );
					else :
						$tweets_json = json_decode( $tweets_data, true );
						$tweets = $tweets_json;
						set_transient( $transient_name, $tweets_json, 60 * 60 * 2 );
					endif;
				endif;
				
				foreach ( $tweets as $tweet ) :
					$tweet_text = ( string ) $tweet['text'];
					$tweet_text = preg_replace( $patterns, $replace, $tweet_text ); ?>
					<p class="tweet">
						<?php echo $tweet_text; ?>
						<cite><?php _e( 'By', 'blakzr' ); ?> <a href="http://twitter.com/#!/<?php echo $username; ?>">@<?php echo $username; ?></a> <a href="http://twitter.com/#!/<?php echo $username; ?>/status/<?php echo (string) $tweet['id_str']; ?>" target="_blank"><?php echo human_time_diff( strtotime( ( string ) $tweet['created_at'] ), current_time('timestamp') ) . ' ago'; ?></a></cite>
					</p>
					<?php
				endforeach;
				?>
			<?php echo $after_widget; ?>
	    <?php
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
						
		// Update Transient
		$data_url = 'http://api.twitter.com/1/statuses/user_timeline.json?screen_name=' . $new_instance[ 'username' ] . '&count=' . $new_instance[ 'tweets_number' ] . '&include_rts=' . $new_instance[ 'retweet' ];
		$tweets_data = wp_remote_retrieve_body( wp_remote_get( $data_url ) );
												
		if ( is_wp_error( $tweets_data ) ) :
			echo 'Something went wrong!';
		else :
			$tweets_json = json_decode( $tweets_data, true );
			set_transient( 'blakzr_widget_tweets' . $this->number, $tweets_json, 60 * 60 * 2 );
		endif;
		
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'username' ] = strip_tags( $new_instance[ 'username' ] );
		$instance[ 'retweet' ] = empty( $new_instance[ 'retweet' ] ) ? 'false' : 'true';
		if ( ( int ) strip_tags( $new_instance[ 'tweets_number' ] ) < 1) {
			$instance[ 'tweets_number' ] = 1;
		} else {
			$instance[ 'tweets_number' ] = ( int ) strip_tags( $new_instance[ 'tweets_number' ] );
		}
		return $instance;
	}
	
	function form( $instance ) {
		$title = esc_attr( $instance[ 'title' ] );
		$username = empty( $instance[ 'username' ] ) ? '@twitter' : esc_attr( $instance[ 'username' ] );
		$tweets_number = empty( $instance[ 'tweets_number' ] ) ? 3 : esc_attr( $instance[ 'tweets_number' ] );
		$retweet = empty( $instance[ 'retweet' ] ) ? 'true' : esc_attr( $instance[ 'retweet' ] );
	    ?>
	    <p>
	    	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'blakzr' ); ?></label> 
	    	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username', 'blakzr' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" type="text" value="<?php echo $username; ?>" name="<?php echo $this->get_field_name( 'username' ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tweets_number' ); ?>"><?php _e( 'Number of tweets to show', 'blakzr' ); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'tweets_number' ); ?>" type="text" size="3" value="<?php echo $tweets_number; ?>" name="<?php echo $this->get_field_name( 'tweets_number' ); ?>">
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'retweet' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'retweet' ); ?>" value="true"<?php echo $retweet == 'true' ? '  checked="checked"' : ''; ?> />
			<label for="<?php echo $this->get_field_id( 'retweet' ); ?>"><?php _e( 'Show retweets', 'blakzr' ); ?></label>
		</p>
	    <?php 
	}
}

add_action( 'widgets_init', create_function('', 'return register_widget("widget_show_tweets");' ) );


/*************************/
/***** Widget: Video *****/
/*************************/

class widget_video extends WP_Widget {
	function widget_video() {
		$widget_options = array( 'description' => __( 'Display a YouTube or Vimeo video', 'blakzr' ) );
		parent::WP_Widget( false, $name = 'Custom - ' . __( 'Video', 'blakzr' ), $widget_options );	
	}
	
	function widget ( $args, $instance ) {		
	    extract( $args );
		$title = empty( $instance[ 'title' ] ) ? __( 'Featured Video', 'blakzr' ) : apply_filters( 'widget_title', $instance[ 'title' ] );
		$video_type = empty( $instance[ 'video_type' ] ) ? 'youtube' : apply_filters( 'widget_video_type', $instance['video_type'] );
		$video_url = empty( $instance[ 'video_url' ] ) ? '' : apply_filters( 'widget_video_url', $instance[ 'video_url' ] );
	    ?>
	    	<?php echo $before_widget; ?>
				<?php
				echo $before_title . $title . $after_title;
				
				echo do_shortcode('[' . $video_type . ' width="200" height="113"]' . $video_url . '[/' . $video_type . ']');
				
				?>
			<?php echo $after_widget; ?>
	    <?php
	}
	
	function update( $new_instance, $old_instance ) {				
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'video_type' ] = strip_tags( $new_instance[ 'video_type' ] );
		$instance[ 'video_url' ] = strip_tags( $new_instance[ 'video_url' ] );
		return $instance;
	}
	
	function form( $instance ) {				
		$title = esc_attr( $instance[ 'title' ] );
		$video_type = empty( $instance[ 'video_type' ] ) ? 'youtube' : esc_attr( $instance[ 'video_type' ] );
		$video_url = empty( $instance[ 'video_url' ] ) ? '' : esc_attr( $instance[ 'video_url' ] );
	    ?>
	    <p>
	    	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'blakzr' ); ?></label> 
	    	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>
		<p>
			<input type="radio" name="<?php echo $this->get_field_name( 'video_type' ); ?>" value="youtube" id="<?php echo $this->get_field_id( 'video_type' ); ?>_0"<?php echo 'youtube' == $video_type ? ' checked="checked"' : ''; ?>> <label for="<?php echo $this->get_field_id( 'video_type' ); ?>_0">YouTube</label><br />
			<input type="radio" name="<?php echo $this->get_field_name( 'video_type' ); ?>" value="vimeo" id="<?php echo $this->get_field_id( 'video_type' ); ?>_1"<?php echo 'vimeo' == $video_type ? ' checked="checked"' : ''; ?>> <label for="<?php echo $this->get_field_id( 'video_type' ); ?>_1">Vimeo</label>
	    </p>
		<p>
	    	<label for="<?php echo $this->get_field_id( 'video_url' ); ?>"><?php _e( 'URL:', 'blakzr' ); ?></label> 
	    	<input class="widefat" id="<?php echo $this->get_field_id( 'video_url' ); ?>" name="<?php echo $this->get_field_name( 'video_url' ); ?>" type="text" value="<?php echo $video_url; ?>" />
	    </p>
	    <?php 
	}
}

add_action ( 'widgets_init', create_function( '', 'return register_widget ( "widget_video" );' ) );

/************************/
/***** Widget: Maps *****/
/************************/

class widget_map extends WP_Widget {
	function widget_map() {
		$widget_options = array( 'description' => __( 'Display a map from Google Maps', 'blakzr' ) );
		parent::WP_Widget( false, $name = 'Custom - ' . __( 'Map', 'blakzr' ), $widget_options );	
	}
	
	function widget ( $args, $instance ) {		
	    extract( $args );
		$title = empty( $instance[ 'title' ] ) ? __( 'Map', 'blakzr' ) : apply_filters( 'widget_title', $instance[ 'title' ] );
		$map_lat = empty( $instance[ 'map_lat' ] ) ? '51.481784' : apply_filters( 'widget_map_lat', $instance['map_lat'] );
		$map_lng = empty( $instance[ 'map_lng' ] ) ? '-0.144246' : apply_filters( 'widget_map_lng', $instance['map_lng'] );
		$map_height = empty( $instance[ 'map_height' ] ) ? '180' : apply_filters( 'widget_map_height', $instance['map_height'] );
		$map_type = empty( $instance[ 'map_type' ] ) ? 'ROADMAP' : apply_filters( 'widget_map_type', $instance['map_type'] );
		$map_zoom = empty( $instance[ 'map_zoom' ] ) ? '8' : apply_filters( 'widget_map_zoom', $instance['map_zoom'] );
	    ?>
	    	<?php echo $before_widget; ?>
				<?php
				echo $before_title . $title . $after_title;
				
				echo do_shortcode('[gmap lat=' . $map_lat . ' lng=' . $map_lng . ' width="200" height="' . $map_height . '" type="' . $map_type . '" zoom="' . $map_zoom . '"]');
				
				?>
			<?php echo $after_widget; ?>
	    <?php
	}
	
	function update( $new_instance, $old_instance ) {				
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'map_lat' ] = strip_tags( $new_instance[ 'map_lat' ] );
		$instance[ 'map_lng' ] = strip_tags( $new_instance[ 'map_lng' ] );
		$instance[ 'map_height' ] = strip_tags( $new_instance[ 'map_height' ] );
		$instance[ 'map_type' ] = strip_tags( $new_instance[ 'map_type' ] );
		$instance[ 'map_zoom' ] = strip_tags( $new_instance[ 'map_zoom' ] );
		return $instance;
	}
	
	function form( $instance ) {				
		$title = esc_attr( $instance[ 'title' ] );
		$map_lat = empty( $instance[ 'map_lat' ] ) ? '51.481784' : esc_attr( $instance['map_lat'] );
		$map_lng = empty( $instance[ 'map_lng' ] ) ? '-0.144246' : esc_attr( $instance['map_lng'] );
		$map_height = empty( $instance[ 'map_height' ] ) ? '180' : esc_attr( $instance['map_height'] );
		$map_type = empty( $instance[ 'map_type' ] ) ? 'ROADMAP' : esc_attr( $instance['map_type'] );
		$map_zoom = empty( $instance[ 'map_zoom' ] ) ? '8' : esc_attr( $instance['map_zoom'] );
	    ?>
	    <p>
	    	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'blakzr' ); ?></label> 
	    	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>
		<p>
	    	<label for="<?php echo $this->get_field_id( 'map_lat' ); ?>"><?php _e( 'Latitude:', 'blakzr' ); ?></label> 
	    	<input class="widefat" id="<?php echo $this->get_field_id( 'map_lat' ); ?>" name="<?php echo $this->get_field_name( 'map_lat' ); ?>" type="text" value="<?php echo $map_lat; ?>" />
	    </p>
		<p>
	    	<label for="<?php echo $this->get_field_id( 'map_lng' ); ?>"><?php _e( 'Longitude:', 'blakzr' ); ?></label> 
	    	<input class="widefat" id="<?php echo $this->get_field_id( 'map_lng' ); ?>" name="<?php echo $this->get_field_name( 'map_lng' ); ?>" type="text" value="<?php echo $map_lng; ?>" />
	    </p>
		<p>
	    	<label for="<?php echo $this->get_field_id( 'map_type' ); ?>"><?php _e( 'Map Type:', 'blakzr' ); ?></label> 
	    	<select name="<?php echo $this->get_field_name( 'map_type' ); ?>" id="<?php echo $this->get_field_id( 'map_type' ); ?>">
				<?php
				
				$map_types = array('Roadmap', 'Satellite', 'Hybrid', 'Terrain');
				
				foreach ( $map_types as $type ) :
				?>
				<option value="<?php echo $type; ?>"<?php echo $map_type == $type ? ' selected="selected"' : '' ?>><?php echo $type; ?></option>
				<?php
				endforeach;
				
				?>
			</select>
	    </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'map_zoom' ); ?>"><?php _e( 'Zoom:', 'blakzr' ); ?></label> 
	    	<select name="<?php echo $this->get_field_name( 'map_zoom' ); ?>" id="<?php echo $this->get_field_id( 'map_zoom' ); ?>">
				<?php
				
				for ( $i = 1; $i < 19 ; $i++ ) { 
					?>
				<option value="<?php echo $i; ?>"<?php echo $map_zoom == $i ? ' selected="selected"' : '' ?>><?php echo $i; ?></option>	
					<?php
				}
				
				?>
			</select>
		</p>
		<p>
	    	<label for="<?php echo $this->get_field_id( 'map_height' ); ?>"><?php _e( 'Map Height:', 'blakzr' ); ?></label> 
	    	<input id="<?php echo $this->get_field_id( 'map_height' ); ?>" name="<?php echo $this->get_field_name( 'map_height' ); ?>" type="text" value="<?php echo $map_height; ?>" style="width:50px;" /> pixels
	    </p>
	    <?php 
	}
}

add_action ( 'widgets_init', create_function( '', 'return register_widget ( "widget_map" );' ) );


/*********************************************/
/*********** Widget: Social Links ************/
/*********************************************/

class widget_social_links extends WP_Widget {
	
	function widget_social_links() {
		$widget_options = array('description' => __('Display your social networks. Set them on the \'Social Links\' tab in the Theme Options page', 'blakzr'));
		parent::WP_Widget(false, $name = 'Custom - ' . __('Social Links', 'blakzr'), $widget_options);	
	}
	
	function widget($args, $instance) {		
	    extract($args);
		$title = empty($instance['title']) ? __('Follow us on', 'blakzr') : apply_filters('widget_title', $instance['title']);
		$description = empty($instance['description']) ? '' : apply_filters('widget_description', $instance['description']);
	    ?>
	    	<?php echo $before_widget; ?>
				<?php
				echo $before_title . $title . $after_title;
				
				if ( '' != $description ) :
					echo '<p>' . $description . '</p>';
				endif;
				
				?>
				<ul class="buttons-wrapper group">
				<?php
				$social_links = blakzr_social_links();
				foreach ( $social_links as $id => $social ) :
				?>
					<li id="<?php echo $id; ?>"><a href="<?php echo $social[1]; ?>" target="_blank"><?php echo $social[0]; ?></a></li>
				<?php
				endforeach;
				?>
					<?php if ( 'true' == get_option( 'blakzr_social_rss', 'true' ) ) : ?>
						<?php if ( '' != get_option( 'blakzr_rss_url', '' ) ) : ?>
					<li id="rss"><a href="<?php echo get_option( 'blakzr_rss_url' ); ?>" ><?php _e( 'RSS', 'blakzr' ); ?></a></li>
						<?php else : ?>
					<li id="rss"><a href="<?php bloginfo( 'rss2_url' ); ?>"><?php _e( 'RSS', 'blakzr' ); ?></a></li>
						<?php endif; ?>
					<?php endif; ?>
				</ul>
			<?php echo $after_widget; ?>
	    <?php
	}
	
	function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['description'] = strip_tags($new_instance['description']);
		return $instance;
	}
	
	function form($instance) {				
		$title = esc_attr($instance['title']);
		$description = empty($instance['description']) ? '' : esc_attr($instance['description']);
	    ?>
	    <p>
	    	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'blakzr'); ?></label> 
	    	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>
		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:', 'blakzr'); ?></label>
			<textarea name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>" class="widefat" cols="20" rows="5"><?php echo $description; ?></textarea>
		</p>
	    <?php 
	}
}

add_action('widgets_init', create_function('', 'return register_widget("widget_social_links");'));


?>