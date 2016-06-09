<?php
/**
 * Welcome to the Functions.php file!
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 692;

/**
 * Display navigation to next/previous pages when applicable
 */
function blakzr_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="page-navigation group">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> <span>Anteriores</span>', 'blakzr' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( '<span>Recientes</span> <span class="meta-nav">&rarr;</span>', 'blakzr' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}

/**
 * Display Author Link
 */
if ( ! function_exists( 'blakzr_get_author_link' ) ) {
	/**
	 * Prints the name of the author with a link to the author posts page.
	 */
	function blakzr_get_author_link( $img = '' ) {
		echo 'avatar' == $img ? get_avatar( get_the_author_meta( 'ID' ), 15 ) : '';
		printf( '<a href="%1$s" title="%2$s" class="author-link" rel="author">%3$s</a>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'blakzr' ), get_the_author()),
			get_the_author()
		);
	}
}

/**
 * Display Post Categories & Tags
 */
if ( ! function_exists( 'blakzr_get_taxonomies' ) ) {
	function blakzr_get_taxonomies() {
		// Retrieves tag list of current post, separated by commas.
		$tag_list = get_the_tag_list( '', '' );
		
		?><div class="entry-taxonomies">
			<?php if ( $tag_list ) : ?>
			<div class="entry-tags">
				<?php echo __( 'Etiquetas: ' ) . $tag_list; ?>
			</div>
			<?php endif; ?>
		</div><!-- .entry-taxonomies -->
		<?php
	}
}

/**
 * Display Post Author
 */
if ( ! function_exists( 'blakzr_get_post_author' ) ) {
	function blakzr_get_post_author() {
		?><div class="entry-author post-section group">
			<?php
			$googleplus = get_the_author_meta( 'googleplus' );
			if ( !empty( $googleplus ) ) :
			?>
			<a href="https://plus.google.com/<?php echo $googleplus; ?>/posts?rel=author" rel="me" target="_blank" class="author-avatar">
				<img src="https://plus.google.com/s2/photos/profile/<?php echo $googleplus; ?>?sz=100" width="100" height="100" alt="<?php the_author_meta( 'display_name' ); ?>">
			</a>
			<?php else : ?>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author" class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 150 ); ?>
			</a>
			<?php endif; ?>
			<div class="author-descrip">
				<h4><?php the_author_meta( 'display_name' ); ?></h4>
				<p><?php the_author_meta( 'user_description' ); ?></p>
				<?php
				$googleplus = get_the_author_meta( 'googleplus' );
				if ( !empty( $googleplus ) ) :
				?>
				<ul class="social-profiles">
					<li><?php printf( '<a href="https://plus.google.com/%2$s/posts?rel=author" rel="me" target="_blank" class="gplus">Sigue a %1$s en Google+</a>', get_the_author_meta( 'first_name' ), $googleplus ); ?></li>
				</ul>
				<?php endif; ?>
				<!-- <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php printf( __( 'Ver mas posts de %s', 'blakzr' ), get_the_author_meta( 'display_name' ) ); ?></a> -->
			</div>
		</div><!-- .entry-taxonomies -->
		<?php
	}
}


/**
 * Display Related Posts
 */

if ( ! function_exists( 'blakzr_get_related_posts' ) ) {
	function blakzr_get_related_posts() {
		?>
		<div class="entry-related post-section group">
			<h3 class="section-title"><?php _e( 'Entradas Relacionadas', 'blakzr' ); ?></h3>
			<?php  
			$orig_post = $post;
			global $post;
			$tags = wp_get_post_tags($post->ID);
            
			if ( $tags ) :
				$tag_ids = array();
				foreach ( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;
				$args = array(
					'tag__in' 			=> $tag_ids,
					'post__not_in' 		=> array( $post->ID ),
					'posts_per_page'	=> 4,
					'caller_get_posts'	=> 1  
				);  
            
				$my_query = new wp_query( $args );  
            
				while ( $my_query->have_posts() ) :
					$my_query->the_post();  
					?>
			<div class="blog-excerpt group">
				<a href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'thumbnail' ); ?>
					<?php else : ?>
					<img src="<?php echo get_template_directory_uri(); ?>/img/blogthumb.png" width="250" height="250" alt="<?php the_title(); ?>">
					<?php endif; ?>
				</a>
				<div class="blog-excerpt-descrip">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<p><?php echo trim( substr( get_the_excerpt(), 0, 75 ) ); ?>....</p>
				</div>
			</div>
				<?php
				endwhile;
			endif;
			$post = $orig_post;  
			wp_reset_query();  
			?>
		</div>
		<?php
	}
}


add_filter( 'the_content', 'shortcode_paragraph_fix' );

function shortcode_paragraph_fix( $content )
{
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);

	$content = strtr( $content, $array );
	return $content;
}

/**
 * Template for comments and pingbacks.
 */
if ( ! function_exists( 'blakzr_comment' ) ) {
	function blakzr_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<div <?php comment_class( 'comment' ); ?>>
			<p><?php _e( 'Pingback:', 'blakzr' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Editar', 'blakzr' ), '<span class="edit-link">(', ')</span>' ); ?></p>
		</div>
		<?php
				break;
			default :
		?>
		<div <?php comment_class('comment group'); ?> id="comment-<?php comment_ID(); ?>">
			<div class="vcard">
				<?php echo get_avatar($comment, 80); ?>
			</div>
			<div class="comment-content">
				<p><cite class="fn" data-auth="[<?php _e('Autor', 'blakzr'); ?>]"><?php comment_author_link(); ?> </cite> <span class="date"><?php _e( 'en', 'blakzr' ) ?> <?php
				printf( '<a href="%1$s" title="%3$s"><time pubdate datetime="%2$s">%3$s</time></a>',
					esc_url( get_comment_link( $comment->comment_ID ) ),
					get_comment_time( 'c' ),
					/* translators: 1: date, 2: time */
					sprintf( __( '%1$s a las %2$s', 'blakzr' ), get_comment_date(), get_comment_time() )
				)
				?></span></p>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( '&rarr; Tu comentario esta pendiente de moderacion.', 'blakzr' ); ?></em>
				<?php endif; ?>
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Editar', 'blakzr' ), '<span class="edit-link">', '</span>' ); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'blakzr' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</div><!-- .comment -->
	
		<?php
				break;
		endswitch;
	}
}

/**
 * Get First Post Embeded Image
 */

// Get first image

if ( ! function_exists( 'blakzr_get_first_image' ) ) {
	
	function blakzr_get_first_image() {
		
		global $post, $posts;
		$first_img = '';
		ob_start();
		ob_end_clean();
		if ( preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches ) ) :
			$first_img = $matches[1][0];
			return $first_img;
		else :
			return false;
		endif;
		
	}
	
}

/**
 * Automatically add rel="lightbox" to image links
 */

add_filter( 'the_content', 'blakzr_addcolorboxtitle_replace', 99 );
add_filter( 'the_excerpt', 'blakzr_addcolorboxtitle_replace', 99 );

function blakzr_addcolorboxtitle_replace( $content ){
	global $post;
	// [0] <a xyz href="...(.bmp|.gif|.jpg|.jpeg|.png)" zyx>yx</a> --> <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz zyx>yx</a>
	$pattern[0]		= "/(<a)([^\>]*?) href=('|\")([^\>]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")([^\>]*?)>(.*?)<\/a>/i";
	$replacement[0]	= '$1 href=$3$4$5$6$2$7>$8</a>';
	// [1] <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz zyx>yx</a> --> <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" rel="lightbox[POST-ID]" xyz zyx>yx</a>
	$pattern[1]		= "/(<a href=)('|\")([^\>]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")([^\>]*?)(>)(.*?)(<\/a>)/i";
	$replacement[1]	= '$1$2$3$4$5 rel="lightbox['.$post->ID.']"$6$7$8$9';
	// [2] <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" rel="lightbox[POST-ID]" xyz rel="(lightbox|nolightbox)yxz" zyx>yx</a> --> <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz rel="(lightbox|nolightbox)yxz" zyx>yx</a>
	$pattern[2]		= "/(<a href=)('|\")([^\>]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\") rel=('|\")lightbox([^\>]*?)('|\")([^\>]*?) rel=('|\")(lightbox|nolightbox)([^\>]*?)('|\")([^\>]*?)(>)(.*?)(<\/a>)/i";
	$replacement[2]	= '$1$2$3$4$5$9 rel=$10$11$12$13$14$15$16$17';
	// [3] <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz>yx title=yxz xy</a> --> <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz title=yxz>yx title=yxz xy</a>
	$pattern[3]		= "/(<a href=)('|\")([^\>]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")([^\>]*?)(>)(.*?) title=('|\")(.*?)('|\")(.*?)(<\/a>)/i";
	$replacement[3]	= '$1$2$3$4$5$6 title=$9$10$11$7$8 title=$9$10$11$12$13';
	// [4] <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz title=zxy xzy title=yxz>yx</a> --> <a href="...(.bmp|.gif|.jpg|.jpeg|.png)" xyz title=zxy xzy>yx</a>
	$pattern[4]		= "/(<a href=)('|\")([^\>]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")([^\>]*?) title=([^\>]*?) title=([^\>]*?)(>)(.*?)(<\/a>)/i";
	$replacement[4]	= '$1$2$3$4$5$6 title=$7$9$10$11';
	$content = preg_replace( $pattern, $replacement, $content );
	return $content;
}

/* Custom Meta Boxes
-------------------------------------------------------------- */



/**
 * Social Links
 */

function blakzr_social_links() {

	$social_links = array(
		'fb'	=>	array( 'Facebook', get_option( 'blakzr_social_facebook', '' ) ),
		'tw'	=>	array( 'Twitter', get_option( 'blakzr_social_twitter', '' ) ),
		'gp'	=>	array( 'Google+', get_option( 'blakzr_social_gplus', '' ) ),
		'fk'	=>	array( 'Flickr', get_option( 'blakzr_social_flickr', '' ) ),
		'is'	=>	array( 'Instagram', get_option( 'blakzr_social_instagram', '' ) ),
		'tb'	=>	array( 'Tumblr', get_option( 'blakzr_social_tumblr', '' ) ),
		'db'	=>	array( 'Dribbble', get_option( 'blakzr_social_dribbble', '' ) ),
		'in'	=>	array( 'LinkedIn', get_option( 'blakzr_social_linkedin', '' ) ),
		'vm'	=>	array( 'Vimeo', get_option( 'blakzr_social_vimeo', '' ) ),
		'pt'	=>	array( 'Pinterest', get_option( 'blakzr_social_pinterest', '' ) ),
		'yt'	=>	array( 'YouTube', get_option( 'blakzr_social_youtube', '' ) )
	);
	
	$social_filtered = array();
	
	foreach ( $social_links as $id => $social ) :
		if ( '' != $social[1] ) :
		
			$url = $social[1];
			
			switch ( $id ) :
				case 'tw' :
					$url = 'https://twitter.com/' . $url;
					break;
				case 'db' :
					$url = 'http://dribbble.com/' . $url;
					break;
				case 'vm' :
					$url = 'https://vimeo.com/' . $url;
					break;
				case 'pt' :
					$url = 'https://pinterest.com/' . $url;
					break;
				case 'yt' :
					$url = 'https://www.youtube.com/user/' . $url;
					break;
				case 'is' :
					$url = 'http://instagram.com/' . $url;
					break;
				default:
					$url = $social[1];
					break;
			endswitch;
			
			$social_filtered[$id] = array( $social[0], $url );
			
		endif;
	endforeach;
	
	return $social_filtered;
	
}

/**
 * Localization Support
 */

/*load_theme_textdomain( 'blakzr', TEMPLATEPATH . '/lang' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/lang/$locale.php";
if ( is_readable( $locale_file ) ) require_once( $locale_file );*/

/**
 * Add Theme Support
 */

/* Post Formats */
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'video' ) );
}

/* Image Sizes / Thumbnails */
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'notas', 270, 165, true );
	//add_image_size( 'minithumb', 100, 100, true );
	//add_image_size( 'blogthumb', 200, 200, true );
	//add_image_size( 'bigthumb', 300, 300, true );
}

/* Editor Style */
if ( function_exists( 'add_editor_style' ) ) { 
	add_editor_style();
}

/* Custom Menus */
add_action( 'init', 'register_menus' );

function register_menus(){
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
				'primary' 		=> __( 'Navegación primaria', 'blakzr' ),
				'dir'			=> __( 'Direcciones', 'blakzr' ),
				'destacados'	=> __( 'Destacados', 'blakzr' )
			)
		);
	}
}

/**
 * Walker Class for 'Direcciones' menu
 */
 
class Description_Walker extends Walker_Nav_Menu {
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array $args    Additional strings.
     * @return void
     */
	 
	
    function start_el(&$output, $item, $depth, $args)
    {
        $classes = empty ( $item->classes ) ? array () : (array) $item->classes;

        $class_names = join(
        	' '
            , apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item )
        );

        ! empty ( $class_names )
            and $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= "<li id='menu-item-$item->ID' $class_names>";

        $attributes  = '';

        ! empty( $item->attr_title )
            and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        ! empty( $item->target )
            and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        ! empty( $item->xfn )
            and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        ! empty( $item->url )
            and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

        // insert description for top level elements only
        // you may change this
        $description = ( ! empty ( $item->description ) and 0 == $depth )
            ? '<span class="nav-desc">' . esc_attr( $item->description ) . '</span>' : '';

        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $item_output = $args->before
            . "<a $attributes>"
            . $description
            . $args->link_before
            . $title
            . '</a> '
            . $args->link_after
            . $args->after;

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
        ,   $item_output
        ,   $item
        ,   $depth
        ,   $args
        );
    }  
}


/**
 * Walker Class for 'Destacados' menu
 */
 
class Description_Walker_destacados extends Walker_Nav_Menu {
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array $args    Additional strings.
     * @return void
     */
	 
	
    function start_el(&$output, $item, $depth, $args)
    {
        $classes = empty ( $item->classes ) ? array () : (array) $item->classes;

        $class_names = join(
        	' '
            , apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item )
        );

        ! empty ( $class_names )
            and $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= "<li id='menu-item-$item->ID' $class_names>";

        $attributes  = '';

        ! empty( $item->attr_title )
            and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        ! empty( $item->target )
            and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        ! empty( $item->xfn )
            and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        ! empty( $item->url )
            and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

        // insert description for top level elements only
        // you may change this
        $description = ( ! empty ( $item->description ) and 0 == $depth )
            ? '<span class="nav-desc">' . esc_attr( $item->description ) . '</span>' : '';

        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $item_output = $args->before
            . "<a $attributes>"
            . $args->link_before
            . "<h3>$title</h3>"
            . "<p>$description</p>"
            . '</a> '
            . $args->link_after
            . $args->after;

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
        ,   $item_output
        ,   $item
        ,   $depth
        ,   $args
        );
    } 
}

/**
 * Filter for wp_get_archives()
 */

function my_custom_post_type_archive_where( $where, $args ) {
	$post_type = isset( $args['post_type'] ) ? $args['post_type'] : 'post';
	$where = "WHERE post_type = '$post_type' AND post_status = 'publish'";
	return $where;  
}

add_filter( 'getarchives_where','my_custom_post_type_archive_where', 10, 2);


/**
 * Register Scripts and Styles 
 */

add_action( 'init', 'register_scripts' );

function register_scripts(){
	
	/* Register Scripts */
	wp_register_script( 'gmaps', 'http://maps.google.com/maps/api/js?sensor=true', array( 'jquery' ), '3.0' );
	wp_register_script( 'colorbox', get_template_directory_uri() . '/js/jquery.colorbox-min.js', array('jquery'), '1.3.20' );
	wp_register_script( 'validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), '1.10.0' );
	wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'), '1.4.8' );
	wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '2.1' );
	wp_register_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.js', array( 'jquery' ), '1.3' );
	wp_register_script( 'theme-custom-code', get_template_directory_uri() . '/js/code.js', array( 'jquery' ), '1.0' );
	wp_register_script( 'theme-custom-admin-code', get_template_directory_uri() . '/js/admin-code.js', array( 'jquery' ), '1.0' );
	wp_register_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.0' );
	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array( 'jquery' ), '2.6.2' );
	wp_register_script( 'carrousel', get_template_directory_uri() . '/js/jquery.carouFredSel-5.6.4.js', array( 'jquery' ), '2.6.2' );
	
	/* Register Styles */
	wp_register_style( 'flexslider-css', get_template_directory_uri() . '/css/flexslider.css', false, '2.1', 'all' );
	wp_register_style( 'admin-style', get_template_directory_uri() . '/css/admin-style.css', false, '1.0', 'all' );
	
}

/* Add script to Admin area */

add_action( 'admin_enqueue_scripts', 'add_custom_admin_script' );
function add_custom_admin_script( $hook ){
	
	global $post;
	
	if ( 'post-new.php' == $hook || 'post.php' == $hook ) :
		if ( 'page' == $post->post_type ) :
			wp_enqueue_style( 'admin-style' );
			wp_enqueue_script( 'theme-custom-admin-code' );
		endif;
	endif;
}

// Agregar categorias en paginas
function mostrar_cats_y_tags_en_paginas() {
    register_taxonomy_for_object_type( 'category', 'page');

    register_taxonomy_for_object_type( 'post_tag', 'page');
}
add_action( 'admin_menu', 'mostrar_cats_y_tags_en_paginas');

function gr_widgets_init()
{
    register_sidebar(array(
        'name' => __('Video Stream', 'cenepred'),
        'id' => 'widget-video',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
   register_sidebar(array(
        'name' => __('Video Stream Slider', 'cenepred'),
        'id' => 'widget-video-slider',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'gr_widgets_init');



/* Include scripts */

include_once( get_stylesheet_directory() . '/functions/widgets.php' );
include_once( get_stylesheet_directory() . '/functions/cpt-prensa.php' );
include_once( get_stylesheet_directory() . '/functions/cpt-eventos.php' );
include_once( get_stylesheet_directory() . '/functions/cpt-oportunidades.php' );
include_once( get_stylesheet_directory() . '/functions/cpt-dispositivos.php' );
include_once( get_stylesheet_directory() . '/functions/cpt-normativas.php' );
include_once( get_stylesheet_directory() . '/functions/shortcodes.php' );
include_once( get_stylesheet_directory() . '/functions/panel.php' );
include_once( get_stylesheet_directory() . '/functions/panel-slider.php' ); 
//include_once( get_stylesheet_directory() . '/functions/editor.php' );

?>