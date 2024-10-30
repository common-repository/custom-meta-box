<?php
/*
Plugin Name: Custom Meta Box
Plugin URI:  http://www.studio45.in/
Description: page Wise Custom Meta Box
Version: 1.0
Author: Studio45 Team
Author URI: http://www.studio45.in/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
if (!defined('ABSPATH'))
    exit;
//ob_start();
function ctbox_meta_admin_menu()
{
    include "meta_admin.php";
}
add_action('admin_menu', 'add_studio45_ctbox_admin_pane');
function add_studio45_ctbox_admin_pane()
{
    add_menu_page('ctbox_meta_admin_menu', 'Custom Meta', 'read', 'ctbox_meta_admin_menu', '', plugins_url('assets/link-24.png', __FILE__));
    add_submenu_page('ctbox_meta_admin_menu', 'Custom Meta', 'Custom Meta ', 'read', 'ctbox_meta_admin_menu', 'ctbox_meta_admin_menu');
}
/**
 * **************************************************
 * 
 * @return
 */
function cmb_register_metadata()
{
    add_meta_box('meta-box-id', __('Meta Box', 'textdomain'), 'cmb_display_data', 'post');
    add_meta_box('meta-box-id', __('Meta Box', 'textdomain'), 'cmb_display_data', 'page');
}
add_action('add_meta_boxes', 'cmb_register_metadata');
function cmb_display_data($post)
{
    $s45_customemeta = get_post_meta($post->ID, 's45_customemeta', true);
?>    
<textarea name="s45_customemeta" placeholder="Enter meta" style="width: 100%;height: 250px;"><?php
    echo $s45_customemeta;
?></textarea>    
<?php
}
function cmb_save_metadata($post_id)
{
    update_post_meta($post_id, 's45_customemeta', sanitize_text_field($_REQUEST['s45_customemeta']));
}
add_action('save_post', 'cmb_save_metadata');
add_action('wp_head', 'cmb_plugin_header', 1, high);
function cmb_plugin_header()
{
    $s45meta   = get_post_meta(get_the_ID());
    $user_meta = get_user_meta('1', 'default_option_name', $single);
    if ($s45meta['s45_customemeta']['0'] != "") {
        print_r($s45meta['s45_customemeta']['0']);
    }
    if ($user_meta['0'] != "") {
        print_r($user_meta['0']);
    }
}
?>