<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @package WordPress
 * @subpackage BlakzrFramework
 * @since BlakzrFramework 0.1
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
<meta name="google-site-verification" content="SfcUhkXb9Ktr7ZtoDTwQJqxWdWJtHNbr8PZd6bJ3cJw" />
<meta name="msvalidate.01" content="2A07E60E80C2E81C9322AE31A77E1E46" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'blakzr' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if ( '' != get_option( 'blakzr_rss_url', '' ) ) : ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS 2.0" href="<?php echo get_option('blakzr_rss_url'); ?>">
<?php endif; ?>
<?php if ( '' != get_option( 'blakzr_favicon_url', '' ) ) : ?>
<link rel="icon" href="<?php echo get_option( 'blakzr_favicon_url' ); ?>">
<?php endif; ?>
<?php
	/* Enqueue Stylesheets
	 */
    //echo '<br> Hola: '; bloginfo( 'stylesheet_url' ); 
    
	wp_enqueue_style( 'flexslider-css' );
    
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Load the jQuery plugin to validate the contact form.
	 */
	if ( is_page_template( 'template-contact.php' ) || is_page_template( 'template-reclamaciones.php' ) || is_page_template( 'template-buzon.php' ) )
		wp_enqueue_script( 'validate' );

	//wp_enqueue_script( 'gmaps' );
	wp_enqueue_script( 'fitvids' );
	wp_enqueue_script( 'flexslider' );
	wp_enqueue_script( 'colorbox' );
	wp_enqueue_script( 'superfish' );
	//wp_enqueue_script( 'easing' );
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'theme-custom-code' );
    wp_enqueue_script( 'carrousel' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<!--[if lt IE 9]>
<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-extended-selectors.js"></script>
<![endif]-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50820560-1', 'cenepred.gob.pe');
  ga('send', 'pageview');

</script>
</head>

<body <?php body_class(); ?>>

<? echo '<br> AA: '.wp_nav_menu( array( 'theme_location' => 'dir', 'container' => 'div', 'menu_class' => 'direc', 'depth' => 0, 'walker' => new Description_Walker ) );?>

<header style="background-image: url(http://cenepred.gob.pe/wp-content/uploads/2014/03/banner6.jpg)">
    <div class="top-bar">
        <div class="wrap group">
	        <div class="slogan">"<?php echo get_option( 'blakzr_topbar_slogan', 'A&ntilde;o56 de la inversi&oacute;n para el desarrollo rural y la seguridad alimentaria' ); ?>"</div>
            <div class="the-date">
            	<?php
					setlocale( LC_ALL, 'es_PE' );
					echo strftime( _x( '%A, %e de %B de %G,', 'Header current date format', 'blakzr' ) );
            	?>
            	<span class="time"></span>
            </div>
        </div>
    </div>
    <div class="strap-logo wrap">   
	    <a href="<?php echo home_url( '/' ); ?>" class="logo">
	    	<img alt="CENEPRED" src="<?php echo get_template_directory_uri(); ?>/img/LOGO_BLANCO_FOND.TRANS.png" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
	    </a>
    </div>
    
<div class="wrap group">
        <div class="intro">
	        <h1><?php echo get_option( 'blakzr_header_title', 'Bienvenidos a CENEPRED' ); ?></h1>
	    	<h2><?php echo wpautop(get_option( 'blakzr_header_description', 'El CENEPRED es un organismo público ejecutor que conforma el Sistema Nacional de Gestión de Riesgo de Desastres.' )); ?></h2>
    	</div>
    	<div class="dir">
	    	<h3>Direcciones de línea</h3>
	    	<?php if ( has_nav_menu( 'dir' ) ) : ?>                    
		          <?php wp_nav_menu( array( 'theme_location' => 'dir', 'container' => 'div', 'menu_class' => 'direc', 'depth' => 0, 'walker' => new Description_Walker ) ); ?>
		    <?php endif; ?>
    	</div>
</div>

</header>
<nav id="nav">
    <div class="wrap">
    	<a href="#" id="nav-toggle"><span></span><?php _e( 'Navegación', 'blakzr' ); ?></a>
		<?php if ( has_nav_menu( 'primary' ) ) { ?>                    
	          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'div', 'menu_class' => 'navfirstlevel' ) ); ?>
	    <?php } else { ?>
		<ul class="navfirstlevel">
			<li><a href="<?php echo site_url( '/' ); ?>"><?php _e('Home', 'blakzr'); ?></a></li>
		</ul>
		<?php } ?>
    </div>
</nav>