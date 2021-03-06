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
<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri();?>/images/icon/favicon.jpg" />
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
<meta name="google-site-verification" content="SfcUhkXb9Ktr7ZtoDTwQJqxWdWJtHNbr8PZd6bJ3cJw" />
<meta name="msvalidate.01" content="2A07E60E80C2E81C9322AE31A77E1E46" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri();?>/css/listanoticia.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri();?>/css/nr_main.css">
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

<header class="main wrap"> 	
	<div class="logo left">
		<img src="<?php echo get_template_directory_uri();?>/img/logo_cenepred.png" border="0" height="170px"/>
	</div>
	<div class="left">
		<h2 class="lema">"Promoviendo Cultura de prevención"</h2>		
	</div>
	<div class="social_media left">
		<ul>
			<li><a id="tw" target="_blank" href="https://twitter.com/CENEPRED">Twitter</a></li>
			<li><a id="fb" target="_blank" href="https://www.facebook.com/cenepred/timeline/">Facebook</a></li>
			<li><a id="yt" target="_blank" href="https://www.youtube.com/channel/UCw9I7jPR0NLMqT2DmDGgMeQ">Youtube</a></li>
			<li><a id="ml" target="_blank" href="mailto:webmaster@cenepred.gob.pe">Mail</a></li>
		</ul>
	</div>
</header>  
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri();?>/css/menu.css">
  
<nav id="nav2"> <!-- style="font-family:Arial, Helvetica, sans-serif;font-size:14px" -->
    <div class="wrap2" style="margin: auto;	margin: 1px 35px; max-width: 100%; padding: 0 0px; ">
    	<a href="#" id="nav-toggle2"><span></span><?php _e( 'Navegación', 'blakzr' ); ?></a>
		<?php if ( has_nav_menu( 'primary' ) ) { ?>             
	          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'div', 'menu_class' => 'navfirstlevel2' ) ); ?>
		<?php 
		} else { ?>
		<ul class="navfirstlevel">
			<li><a href="<?php echo site_url( '/' ); ?>"><?php _e('Home', 'blakzr'); ?></a></li>
		</ul>
		<?php } ?>
    </div>
</nav>