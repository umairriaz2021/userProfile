<?php
/*
Plugin Name: Dipexels User Registration
Plugin URI: https://www.dipexels.com
Description: This plugin is for test purpose
Author Name: Umair Riaz
Author URI: https://www.facebook.com/umair-riaz
Version: 1.0.0
text-domain: dipexels

*/

if(!defined('PLUGIN_DIR_PATH')){
    define('PLUGIN_DIR_PATH',plugin_dir_path(__FILE__));
}


if(!defined('PLUGIN_URL')){
    define('PLUGIN_URL',plugin_dir_url(__FILE__,'/dipexels'));
}


function dipixels_activate_plugin(){
    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $args = ['post_title' => 'Sign up your account','post_name'=>'register','post_type'=>'page','post_status' => 'publish'];
    $args1 = ['post_title' => 'Login Page','post_name'=>'login','post_type'=>'page','post_status' => 'publish'];
    $args2 = ['post_title' => 'Profile Page','post_name'=>'profile','post_type'=>'page','post_status' => 'publish'];
    $args3 = ['post_title' => 'My Account','post_name'=>'my-account','post_type'=>'page','post_status' => 'publish'];
    $insert_page = wp_insert_post($args);
    $insert_page1 = wp_insert_post($args1);
    $insert_page2 = wp_insert_post($args2);
    $insert_page3 = wp_insert_post($args3);
    if($insert_page){
        add_option('register',$insert_page);
    }
    if($insert_page1){
        add_option('login',$insert_page1);
    }
    if($insert_page2){
        add_option('login',$insert_page2);
    }
    if($insert_page3){
        add_option('login',$insert_page3);
    }
    if(count($wpdb->get_var('SHOW TABLES LIKE "gallery"')) == 0)
    {
        $sql1 = "CREATE TABLE `gallery` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` int(11) NOT NULL,
            `title` varchar(200) NOT NULL,
            `desc` text NOT NULL,
            `url` varchar(200) NOT NULL,
            `ext_url` text NOT NULL,
            `img_upload` text NOT NULL,
            `video_thumbnail` text NOT NULL,
            `video_upload` text NOT NULL,
            `desc_status` int(11) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
    
      
      dbDelta( $sql1 );       
    }

     if(count($wpdb->get_var('SHOW TABLES LIKE "brands"')) == 0)
     {
        $sql2 = "CREATE TABLE `brands` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` int(11) NOT NULL,
            `title` varchar(200) NOT NULL,
            `url` text NOT NULL,
            `ext_url` text NOT NULL,
            `img_upload` text NOT NULL,
            `video_thumbnail` text NOT NULL,
            `video_upload` text NOT NULL,
            `desc_status` int(2) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
    
      
      dbDelta( $sql2 );       
    }
   

}

function activation_redirect() {
  
    
  exit( wp_redirect( site_url('/login')));
}
add_action( 'activated_plugin', 'activation_redirect' );


register_activation_hook(__FILE__,'dipixels_activate_plugin');

function dipixels_deactivate_plugin(){
    require_once( trailingslashit( ABSPATH ) .'wp-load.php' );    
global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS gallery ");
$wpdb->query("DROP TABLE IF EXISTS brands");
$page_id = get_page_by_title('Sign up your account')->ID;
$page_id1 = get_page_by_title('Login Page')->ID;
$page_id2 = get_page_by_title('Profile Page')->ID;
$page_id3 = get_page_by_title('My Account')->ID;

wp_delete_post($page_id,true);
wp_delete_post($page_id1,true);
wp_delete_post($page_id2,true);
wp_delete_post($page_id3,true);

}
register_deactivation_hook(__FILE__,'dipixels_deactivate_plugin');



require_once PLUGIN_DIR_PATH.'/inc/functions.php';


function dipexel_create_user($uname,$pass,$email){
   $userid =  wp_create_user( $uname, $pass, $email );
   return $userid;
}

require_once PLUGIN_DIR_PATH.'/inc/userprofile.php';
require_once PLUGIN_DIR_PATH.'/inc/image-upload-fn.php';
