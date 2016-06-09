<?php
/**
 * Plugin Name: Sliding Side Tabs
 * Plugin URI: http://www.slrlounge.com/
 * Description: Creates a jQuery-based, fully-widgetized Side Tabs.
 * Version: 0.1
 * Author: Trung Van
 * Author URI: http://www.slrlounge.com
 */
 
load_plugin_textdomain( 'side-tab', false, '/side-tab' );

/**
 * Make sure we get the correct directory.
 * @since 0.1
 */
if ( !defined('WP_CONTENT_URL' ) )
	define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( !defined( 'WP_CONTENT_DIR' ) )
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( !defined( 'WP_PLUGIN_URL' ) )
	define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( !defined( 'WP_PLUGIN_DIR' ) )
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

/**
 * Define constant paths to the plugin folder.
 * @since 0.1
 */
define( SIDE_TAB, WP_PLUGIN_DIR . '/side-tab' );
define( SIDE_TAB_URL, WP_PLUGIN_URL . '/side-tab' );

/**
 * Add actions
 * @since 0.1
 */
add_action( 'init', 'side_tab_register_sidebars' );
//add_action( 'template_redirect', 'load_side_tab' );

/**
 * Loads JS and CSS if the sidebar is active and not in admin.
 * @since 0.1
 */
if ( !is_admin() && is_active_sidebar( 'side-tab1' ) ) :
   
	wp_enqueue_style( 'side-tab', SIDE_TAB_URL . '/sidetab.css', false, 0.1, 'screen' );
    wp_enqueue_style( 'side-tab1', SIDE_TAB_URL . '/dynamic-css.php', false, 0.1, 'screen' );
   	//wp_enqueue_script( 'side-tab-js', SIDE_TAB_URL . '/sidetab.js', array( 'jquery' ), '0.1', true );
    wp_enqueue_script('jquery');
    wp_register_script('side-tab-js',SIDE_TAB_URL . '/sidetab.js');
    wp_enqueue_script('side-tab-js');    
endif;

/**
 * Registers the sliding panel widget area.
 * @uses register_sidebar()
 *
 * @since 0.1
 */
function side_tab_register_sidebars() {
    $Sidetab_newOptions = get_option('Sidetab_options');
    $tabs=$Sidetab_newOptions['tabs'];
    for($i=1;$i<=$tabs;$i++){
        register_sidebar( array( 'name' => __('Side Tab'.$i, 'side-tab'), 'id' => 'side-tab'.$i, 'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-inside">', 'after_widget' => '</div></div>', 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>' ) );        
    }
    
	
}

add_action('admin_menu', 'side_bar_admin_pages' );
function side_bar_admin_pages(){

	if( function_exists('add_options_page') ) {
		if( current_user_can('manage_options') ) {
			if (!class_exists('ssBase')) $plugin_page = add_options_page(__('Side Tabs', 'side-tab'),__('Side Tabs', 'side-tab'), 8, 'side-tab', 'sidetab_ui');
    	}					
	}
}

/**
* Outputs the HTML for the admin sub page.
*/
function sidetab_ui(){
	global $base_over_ride;
	global $login_domain;
	include_once 'admin/sidetab-ui.php';
} 
/**
 * Displays the sliding panel if the widget area is active.
 * This can be manually called in the templates with:
 *	<?php if ( function_exists( 'get_side_tab' ) ) get_side_tab(); ?>
 *
 * @uses is_active_sidebar()
 * @since 0.1
 */
function get_side_tab() {
    
    $Sidetab_newOptions = get_option('Sidetab_options');  

    $tabs=$Sidetab_newOptions['tabs'];
  

        for($i=1;$i<=$tabs;$i++){
            
                if ( is_active_sidebar( 'side-tab'.$i ) ) {
     
                    $tabtext=$Sidetab_newOptions['tabtext'.$i]?$Sidetab_newOptions['tabtext'.$i]:'More info';
                    $Strtab='';
                    for($j=0;$j<strlen($tabtext);$j++){
                        if(($tabtext[$j])){
                           $Strtab .="<span>$tabtext[$j]</span>";
                        }
                    }
                        
        ?>
                <div id="side-bar<?=$i?>">
                    <div class="drawer" id="drawer_<?=$i?>" style="z-index: 5000; left: -203px;">
                        
                        <div class="tab" id="tab_<?=$i?>" style="opacity: 0.85;">
                            <?=$Strtab?>            
                        </div><!-- .tab -->
                        
                        <ul class="drawer_content" id="drawer_content_<?=$i?>" style="opacity: 0.85; height: 575px;">					
                            <?php dynamic_sidebar( 'side-tab'.$i ); ?>
                        <div style="bottom:0;clear:both;position:absolute;"><a style="color:#666;" target="_new" href="http://www.slrlounge.com/side-tab-wordpress-plugin-free-slr-lounge-download">powered by SLR Lounge</a></div>
                        </ul><!-- .drawer_content -->
                        
                    </div>
                </div>

            <?  
             	}         
        }
   

}



?>