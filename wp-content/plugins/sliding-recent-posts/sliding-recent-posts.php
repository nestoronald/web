<?php
/*
  Plugin Name: Sliding Recent Posts
  Plugin URI: http://smartcatdesign.net/under-construction-maintenance-mode-free-wordpress-plugin/
  Description: Display your recent articles and posts in a sliding widget
  Version: 1.0.0
  Author: SmartCat
  Author URI: http://smartcatdesign.net
  License: GPL v2
 */

register_activation_hook(__FILE__, 'srp_install');
add_action('admin_menu', 'srp_menu');
add_action('wp_head', 'show_srp');
add_action('single_template','srp_popup');
add_action('admin_enqueue_scripts','srp_scripts');
add_action('admin_enqueue_scripts','srp_scripts');
wp_register_style( 'custom_wp_admin_css', plugins_url() . '/sliding-recent-posts/admin/jquery.miniColors.css', false, '1.0.0' );
wp_enqueue_style( 'custom_wp_admin_css' );

function srp_scripts(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('colors', plugins_url() . '/sliding-recent-posts/script/jquery.miniColors.js');
}

function srp_install() {
    global $wp_version;
    if (version_compare($wp_version, "3.2.1", "<")) {
        deactivate_plugins(basename(__FILE__));
        wp_die("This plugin requires WordPress version 3.2.1 or higher.");
    }
    set_srp();
}

function set_srp() {
    
    $new_background = ($_REQUEST['background_color'] == "") ? "#464646" : $_REQUEST['background_color'];
    if(get_option('background_color')!== false){
        update_option('background_color',$new_background);
    }else{
        $deprecated = null;
        $autoload = 'no';
        add_option('background_color',$deprecated,$autoload);
    }
    
    $new_color = ($_REQUEST['font_color'] == "") ? "#ffffff" : $_REQUEST['font_color'];
    if(get_option('font_color') !== false){
        update_option('font_color', $new_color);
    }else{
        $deprecated = null;
        $autoload = 'no';
        add_option('font_color',$deprecated,$autoload);
    }
    
    $new_posts = ($_REQUEST['num_posts'] == '') ? '3' : $_REQUEST['num_posts'];
    if(get_option('num_posts') !== false){
        update_option('num_posts', $new_posts);
    }else{
        add_option('num_posts',null,'no');
    }
    
    $new_position = ($_REQUEST['position'] == '') ? '200' : $_REQUEST['position'];
    if(get_option('position') !== false){
        update_option('position', $new_position);
    }else{
        add_option('position',null,'no');
    }
    
    $new_corners = ($_REQUEST['rounded_corners'] == '') ? 'yes' : $_REQUEST['rounded_corners'];
    if(get_option('rounded_corners') !== false){
        update_option('rounded_corners', $new_corners);
    }else{
        add_option('rounded_corners',null,'no');
    }
}

function srp_action(){
    if(isset($_REQUEST['srp_save'])){
        switch ($_REQUEST['srp_save']){
            case 'save' : 
                set_srp();
                echo '<div class="updated below-h2" id="message" style="position:relative; clear:both;"><p>Settings Saved</p></div>';
                break;
            default :
        }
    }
    $num_posts = get_option('num_posts');
    $background_color = get_option('background_color');
    $font_color = get_option('font_color');
    $position = get_option('position');
    $rounded_corners = get_option('rounded_corners');
    require_once('admin/form.php');
}

function srp_menu(){
    add_menu_page("Recent Posts","Recent Posts","administrator","sliding-recent-posts.php","srp_action",plugins_url('images/icon.png', __FILE__));
}

function srp_popup(){
    
    require_once 'library/popup.php';
}

function show_srp(){
    $num_posts = get_option('num_posts');
    $background_color = get_option('background_color');
    $font_color = get_option('font_color');
    $position = get_option('position');
    $rounded_corners = get_option('rounded_corners');
    
    require_once 'style/slider_css.php';
    require_once 'library/slider.php';
    require_once 'script/script.php';
}

?>