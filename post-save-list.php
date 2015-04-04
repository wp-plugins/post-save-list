<?php
/**
 * Plugin Name: Post Save & List
 * Plugin URI:  https://github.com/markzero/post-save-list
 * Description: This plugin allows you to add Save button next to Publish button. When you click the Save button you'll get redirected to Posts list page.
 * Version:     1.0
 * Author:      Marko Jakic
 * Author URI:  http://markojakic.net/
 * Network: True
 * License: GPL v3
 */

if (!defined('WPINC')) {
	die;
}


add_action('post_submitbox_start', 'psnl_return');
function psnl_return() {
?>
    <div id="publishing-action-save" style="margin-left: 4px; line-height: 23px; float: right; text-align: right;">
        <input name="save" type="submit" class="button button-secondary button-large" value="Save">
    </div>
<?php
}


add_action('redirect_post_location', 'psnl_action', 100, 2);
function psnl_action($loc, $ID) {
    $args = explode('?', $loc);
    $pargs = wp_parse_args($args[1]);

    if (!isset($pargs['message']) || !isset($pargs['action'])) {
        return $loc;
    }

    if ($pargs['message'] == 1 && $pargs['action'] == 'edit'
        && isset($_POST['save']) && $_POST['save'] == 'Save'
        )
    {

        wp_safe_redirect(admin_url('edit.php'));
        exit;
    }

    return $loc;
}

