<?php
namespace Cbcoverseas;

class Events {
	public function initSystem() {
		$forms_path = __DIR__ . '/Forms';
		
		// Override the following actions in order to prevent the notification emails from being sent
		// TODO: Override thn
		elgg_register_action("messages/send", "$forms_path/SendMessage.submit.php");
		elgg_register_action("likes/add", "$forms_path/Like.submit.php");
		
		// Don't want to include the title of the blog in the URL in case we send urls out via email, so override the default.
		elgg_register_entity_url_handler('object', 'blog', function(ElggBlog $blog) {
			return "/blog/view/$blog->guid";
		});
		
		elgg_register_entity_url_handler('object', 'image', function(TidypicsImage $image) {
			$album = $image->getContainerEntity();
			$title = elgg_get_friendly_title($image->getTitle());
			return "/photos/$album->guid/$image->guid/$title";
		});
		
		// These help prevent sending of all notifications, email or otherwise.
		elgg_unregister_event_handler('create', 'object', 'object_notifications');
		
		/**
		 * Prevent sending email notifications. True indicates we've "handled" the notifications.
		 * This is necessary because tidypics calls object_notifications directly.
		 */
		elgg_register_plugin_hook_handler('object:notifications', 'all', function() {
			return true;
		});
		
		elgg_register_plugin_hook_handler('cron', 'hourly', function() {
			global $EVAN;
			return $EVAN->make('Cbcoverseas\Hooks\Cron')->sendBatchOfEmailDigests();
		});
		
		elgg_register_plugin_hook_handler('container_permissions_check', 'object', function($hook, $type, $return, $params) {
			global $EVAN;
			return $EVAN->make('Cbcoverseas\Hooks\Permissions')->hasPermissionToCreateNewObject($hook, $type, $return, $params);
		});
		
		elgg_register_plugin_hook_handler('access:collections:write', 'user', function($hook, $type, $return, $params) {
			global $EVAN;
			return $EVAN->make('Cbcoverseas\Hooks\Permissions')->getWriteAcls($hook, $type, $return, $params);
		});
	}
}