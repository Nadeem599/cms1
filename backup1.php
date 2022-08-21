<?php /*
 * Plugin Name:       Mission 22 like dislike
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Muhammad Nadeem
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       mission-22-like-dislike
 * Domain Path:       /languages
 */
 if( !defined(' MISSION_22_LIKE_DISLIKE_VERSION '))
 {
     define( 'MISSION_22_LIKE_DISLIKE_VERSION' , '1.0.0' );
 }
 if( !defined( 'MISSION_22_LIKE_DISLIKE_DIR')){
     define( 'MISSION_22_LIKE_DISLIKE_DIR' , plugin_dir_url( __FILE__ ));
 }
if( !function_exists( 'mission_22_like_dislike_scripts' )){
 function mission_22_like_dislike_scripts(){
    wp_enqueue_style( 'style-mission-22' , MISSION_22_LIKE_DISLIKE_DIR. '/assets/css/style.css'  );
 }
 add_action( 'wp_enqueue_scripts' , 'mission_22_like_dislike_scripts');
}

function mission_22_like_dislike_plugin_html(){
}
function generate_coupons_func(){
  
        include('fontend.php');
        

}
function mission_22_like_dislike_plugin_register(){
    add_menu_page( 'PLUGIN_22_LIKE_DISLIKE', 'PLUGIN_22_LIKE_DISLIKE', 'manage_options', 'mission_22_like_dislike_plugin', 'mission_22_like_dislike_plugin_html', '', 30);
    add_submenu_page( 'mission_22_like_dislike_plugin', 'GENERATE COUPONS','GENERATE COUPONS', 'manage_options', 'generate_coupons', 'generate_coupons_func', 30);
}
add_action( 'admin_menu' , 'mission_22_like_dislike_plugin_register');
include 'register.php';


add_action( 'wp_ajax_my_action', 'my_action_func' );
function my_action_func(){
  global $wpdb;
  $plans          = array();
  $frequency_lo   = array();
  $random_numbers = array();
  $coupon_name    = '';
  $allowed_uses   = '';
  $expiring_date  = '';
  $cycles         = '';
  $value          = '';
  $cuser_id       = '';
  $var1           =  0;
  $ccoupon_num   = '';


  // if (isset( $_POST['coupon_nonce'] ) && wp_verify_nonce( $_POST['coupon_nonce'], 'coupon_nonce_action' ) ){
  //   echo ' ok';
  //   print_r($_REQUEST['coupon_nonce']);
  // }
  // else{
  //   print_r($_GET['coupon_nonce']);
  //   echo'<br>';
  // }
  
  // if(check_ajax_referer( '_wp_http_referer', $_POST['coupon_nonce'] ))
  // {
  //   echo 'ok ';
  // }
  // else{
  //   echo 'not ok';
  // }

  if (!empty( $_POST['data'] ))
  {
      $all_data = $_POST['data'];
    //  print_r($all_data);
    //  exit();
      foreach($all_data as $x => $val){
        if( !empty($val['value']) && 'coupon_name' == $val['name'])
          {
            $coupon_name = sanitize_text_field($val['value']);
          }
          elseif('allowed_uses' == $val['name'] && !empty($val['value']))
          {
            $allowed_uses = sanitize_text_field($val['value']);
          }
          elseif('expiring_date' == $val['name'] && !empty($val['value']))
          {
            $expiring_date =  sanitize_text_field($val['value']);
          }
          elseif('cycles' == $val['name'] && !empty($val['value']))
          {
            $cycles =  sanitize_text_field($val['value']);
          }
          elseif('plan' == $val['name'] && !empty($val['value']))
          {
            $plans[] =  map_deep($val['value'], 'sanitize_text_field');
          }
          elseif('frequency_lo' == $val['name'] && !empty($val['value']))
          {
            $frequency_lo[] = map_deep($val['value'], 'sanitize_text_field');
          }
          elseif('value' == $val['name'] && !empty($val['value']))
          {
            $value = sanitize_text_field($val['value']);
          }
          else{
            // do nothing
          }

      }

        if ( is_user_logged_in() ) {
            $cuser_id = get_current_user_id();
        }

        $current_dtime = current_time('mysql');
        
        while(count($random_numbers) < 100)
        {
            do{
                  // '1234567890abcdefghijklmnopqrstuvwxyz';
              $uuid36 = wp_generate_uuid4();
              $random_number = substr($uuid36,0,5);
              $random_number2 = substr($uuid36,6,10);
              $coupon_name = $random_number . '-' . $random_number2;
            } while (in_array($random_number, $random_numbers));
            $random_numbers[] = $random_number;
            $ccoupon_num = $random_number;

            $tablename=$wpdb->prefix.'posts';
            $data = array(
              'post_author'   =>  $cuser_id,
              'post_date'     =>  $current_dtime,
              'post_date_gmt' =>  $current_dtime,
              'post_title'    =>  $ccoupon_num,
              'post_name'     =>  $ccoupon_num,
              'post_type'     => 'wpultimo_coupon');

            if( $wpdb->insert( $tablename, $data));
            {
              $var1++;
            }
            
            if($var1 > 0){
              $results = $wpdb->get_results( "SELECT ID FROM {$wpdb->prefix}posts WHERE post_title = $ccoupon_num");
              $id =  $results[0]->ID;

              add_post_meta( $id, 'wpu_title',   $ccoupon_num );
              add_post_meta( $id, 'wpu_expiring_date', $expiring_date );
              add_post_meta( $id, 'wpu_allowed_uses',  $allowed_uses );
              add_post_meta( $id, 'wpu_value',         $value );
              add_post_meta( $id, 'wpu_cycles',        $cycles );
              add_post_meta( $id, 'wpu_allowed_freqs', $frequency_lo );
              add_post_meta( $id, 'wpu_allowed_plans', $plans);
              
              echo 'true';
            }
            
        }
        
    }  
 }


?>

