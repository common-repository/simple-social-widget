<?php
/*
Plugin Name: Simple Connect Widget
Version: 1.2
Plugin URI: http://wordpress.org/extend/plugins/simple-social-widget/
Description: Displays simple social media icons in the sidebar
Author: Andrew Epperson
Author URI: http://eppand.com
Text Domain: simple-social-widget
License: GPL2

Copyright 2014  Andrew Epperson  (email : eppand@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



function ae_action_init() {
	// Localization
	load_plugin_textdomain('simple-social-widget', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
// Add actions
add_action('init', 'ae_action_init');


// Begin Widget Code

class AE_Simple_Social_Widget extends WP_Widget
{
  function AE_Simple_Social_Widget()
  {
    $widget_ops = array('classname' => 'simpleSocialWidget', 'description' => 'Displays icons that link to your social media websites' );
    parent::__construct('AE_Simple_Social_Widget', 'Custom - Simple Social Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

    if ( ' ' != $title)
      echo $before_title . $title . $after_title;
 
    // WIDGET CODE GOES HERE
	$ssw_options = get_option('ssw_options');
	$html = '';	
	if ( '' !== $ssw_options['ssw_twitter_url'] )
		$html .= '<a href="'.$ssw_options['ssw_twitter_url'].'" class="ssw-square ssw-twitter" title="'.__('Twitter', 'simple-social-widget').'" target="_blank"><span>'.__('Twitter', 'simple-social-widget').'</span></a>';
	if ( '' !== $ssw_options['ssw_facebook_url'] )
		$html .= '<a href="'.$ssw_options['ssw_facebook_url'].'" class="ssw-square ssw-facebook" title="'.__('Facebook', 'simple-social-widget').'" target="_blank"><span>'.__('Facebook', 'simple-social-widget').'</span></a>';
	if ( '' !== $ssw_options['ssw_google_url'] )
		$html .= '<a href="'.$ssw_options['ssw_google_url'].'" class="ssw-square ssw-google" title="'.__('Google+', 'simple-social-widget').'" target="_blank"><span>'.__('Google+', 'simple-social-widget').'</span></a>';
	if ( '' !== $ssw_options['ssw_linkedin_url'] )
		$html .= '<a href="'.$ssw_options['ssw_linkedin_url'].'" class="ssw-square ssw-linkedin" title="'.__('LinkedIn', 'simple-social-widget').'" target="_blank"><span>'.__('LinkedIn', 'simple-social-widget').'</span></a>';
	if ( '' !== $ssw_options['ssw_youtube_url'] )
		$html .= '<a href="'.$ssw_options['ssw_youtube_url'].'" class="ssw-square ssw-youtube" title="'.__('YouTube', 'simple-social-widget').'" target="_blank"><span>'.__('YouTube', 'simple-social-widget').'</span></a>';
	if ( '' !== $ssw_options['ssw_pinterest_url'] )
		$html .= '<a href="'.$ssw_options['ssw_pinterest_url'].'" class="ssw-square ssw-pinterest" title="'.__('Pinterest', 'simple-social-widget').'" target="_blank"><span>'.__('Pinterest', 'simple-social-widget').'</span></a>';
	if ( '' !== $ssw_options['ssw_feed_url'] )
		$html .= '<a href="'.$ssw_options['ssw_feed_url'].'" class="ssw-square ssw-rss" title="'.__('RSS', 'simple-social-widget').'" target="_blank"><span>'.__('RSS', 'simple-social-widget').'</span></a>';
	$html .= '<div class="clear clearfix">&nbsp;</div>';
    echo $html;
	
	echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("AE_Simple_Social_Widget");') );


add_action('wp_enqueue_scripts', 'add_ssw_stylesheet');
function add_ssw_stylesheet() {
        wp_register_style( 'sswStyleSheets', plugins_url('ssw-styles.css', __FILE__) );
        wp_enqueue_style( 'sswStyleSheets' );
    }
	

include 'ssw-options.php';

// add Settings link
function set_ssw_plugin_meta($links, $file) {
	$plugin = plugin_basename(__FILE__);
	// create link
	if ($file == $plugin) {
		return array_merge(
			$links,
			array( sprintf( '<a href="options-general.php?page=%s">%s</a>', 'ssw', __('Settings') ) )
		);
	}
	return $links;
}
add_filter( 'plugin_row_meta', 'set_ssw_plugin_meta', 10, 2 );



// Create Shortcode
function simple_social_shortcode() {  
    $ssw_options = get_option('ssw_options');
	$html = '';	
	$html = '<div class="ssw_shortcode">';
	if ( '' !== $ssw_options['ssw_twitter_url'] )
		$html .= '<a href="'.$ssw_options['ssw_twitter_url'].'" class="ssw-square ssw-twitter" title="'.__('Twitter', 'simple-social-widget').'" target="_blank"><span>'.__('Twitter', 'simple-social-widget').'</span></a>';
	if ( '' !== $ssw_options['ssw_facebook_url'] )
		$html .= '<a href="'.$ssw_options['ssw_facebook_url'].'" class="ssw-square ssw-facebook" title="'.__('Facebook', 'simple-social-widget').'" target="_blank"><span>'.__('Facebook', 'simple-social-widget').'</span></a>';
	if ( '' !== $ssw_options['ssw_google_url'] )
		$html .= '<a href="'.$ssw_options['ssw_google_url'].'" class="ssw-square ssw-google" title="'.__('Google+', 'simple-social-widget').'" target="_blank"><span>'.__('Google+', 'simple-social-widget').'</span></a>';
	if ( '' !== $ssw_options['ssw_linkedin_url'] )
		$html .= '<a href="'.$ssw_options['ssw_linkedin_url'].'" class="ssw-square ssw-linkedin" title="'.__('LinkedIn', 'simple-social-widget').'" target="_blank"><span>'.__('LinkedIn', 'simple-social-widget').'</span></a>';
	if ( '' !== $ssw_options['ssw_youtube_url'] )
		$html .= '<a href="'.$ssw_options['ssw_youtube_url'].'" class="ssw-square ssw-youtube" title="'.__('YouTube', 'simple-social-widget').'" target="_blank"><span>'.__('YouTube', 'simple-social-widget').'</span></a>';
	if ( '' !== $ssw_options['ssw_pinterest_url'] )
		$html .= '<a href="'.$ssw_options['ssw_pinterest_url'].'" class="ssw-square ssw-pinterest" title="'.__('Pinterest', 'simple-social-widget').'" target="_blank"><span>'.__('Pinterest', 'simple-social-widget').'</span></a>';
	if ( '' !== $ssw_options['ssw_feed_url'] )
		$html .= '<a href="'.$ssw_options['ssw_feed_url'].'" class="ssw-square ssw-rss" title="'.__('RSS', 'simple-social-widget').'" target="_blank"><span>'.__('RSS', 'simple-social-widget').'</span></a>';
	$html .= '<div class="clear clearfix">&nbsp;</div>';
	$html .= '</div>';
    echo $html;  
}  
add_shortcode('simple-social-widget', 'simple_social_shortcode');  
// END Shortcode