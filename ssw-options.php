<?
// add the admin options page
add_action('admin_menu', 'ssw_admin_add_page');
function ssw_admin_add_page() {
	add_options_page(__('Simple Social Widget', 'simple-social-widget'), __('Simple Social Widget', 'simple-social-widget'), 'manage_options', 'ssw', 'ssw_options_page');
}

// display the admin options page
function ssw_options_page() { ?>
<div>
<?php echo '<h2>' . __('Simple Social Widget', 'simple-social-widget') . '</h2>'; ?>
<form action="options.php" method="post">
<?php settings_fields('ssw_options'); ?>
<?php do_settings_sections('ssw'); ?>

<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>

<? }

// add the admin settings and such
add_action('admin_init', 'ssw_admin_init');
function ssw_admin_init(){
//register_setting( 'ssw_options', 'ssw_options', 'ssw_options_validate' );
register_setting( 'ssw_options', 'ssw_options');
add_settings_section('ssw_main', __('Social Media URL Settings', 'simple-social-widget'), 'ssw_section_text', 'ssw');
add_settings_field('ssw_twitter_url', __('Twitter URL', 'simple-social-widget'), 'ssw_twitter_string', 'ssw', 'ssw_main');
add_settings_field('ssw_facebook_url', __('Facebook URL', 'simple-social-widget'), 'ssw_facebook_string', 'ssw', 'ssw_main');
add_settings_field('ssw_google_url', __('Google+ URL', 'simple-social-widget'), 'ssw_google_string', 'ssw', 'ssw_main');
add_settings_field('ssw_linkedin_url', __('LinkedIn URL', 'simple-social-widget'), 'ssw_linkedin_string', 'ssw', 'ssw_main');
add_settings_field('ssw_pinterest_url', __('Pinterest URL', 'simple-social-widget'), 'ssw_pinterest_string', 'ssw', 'ssw_main');
add_settings_field('ssw_youtube_url', __('YouTube URL', 'simple-social-widget'), 'ssw_youtube_string', 'ssw', 'ssw_main');
add_settings_field('ssw_feed_url', __('RSS Feed URL', 'simple-social-widget'), 'ssw_feed_string', 'ssw', 'ssw_main');
}

function ssw_section_text() {
echo '<p>' . __('Enter the absolute paths of your social media profiles in the fields below. These values will be used for each instance of the widget on your website.', 'simple-social-widget') . '</p>';
}

function ssw_twitter_string() {
	$options = get_option('ssw_options');
	echo "<input id='ssw_twitter_url' name='ssw_options[ssw_twitter_url]' size='70' type='text' value='".$options['ssw_twitter_url']."' />";
} 
function ssw_facebook_string() {
	$options = get_option('ssw_options');
	echo "<input id='ssw_facebook_url' name='ssw_options[ssw_facebook_url]' size='70' type='text' value='".$options['ssw_facebook_url']."' />";
} 
function ssw_google_string() {
	$options = get_option('ssw_options');
	echo "<input id='ssw_google_url' name='ssw_options[ssw_google_url]' size='70' type='text' value='".$options['ssw_google_url']."' />";
} 
function ssw_linkedin_string() {
	$options = get_option('ssw_options');
	echo "<input id='ssw_linkedin_url' name='ssw_options[ssw_linkedin_url]' size='70' type='text' value='".$options['ssw_linkedin_url']."' />";
} 
function ssw_pinterest_string() {
	$options = get_option('ssw_options');
	echo "<input id='ssw_pinterest_url' name='ssw_options[ssw_pinterest_url]' size='70' type='text' value='".$options['ssw_pinterest_url']."' />";
}
function ssw_youtube_string() {
	$options = get_option('ssw_options');
	echo "<input id='ssw_youtube_url' name='ssw_options[ssw_youtube_url]' size='70' type='text' value='".$options['ssw_youtube_url']."' />";
}
function ssw_feed_string() {
	$options = get_option('ssw_options');
	echo "<input id='ssw_feed_url' name='ssw_options[ssw_feed_url]' size='70' type='text' value='".$options['ssw_feed_url']."' />";
}