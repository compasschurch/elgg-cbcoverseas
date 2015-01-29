<?php
namespace Cbcoverseas;

class Events {
	public function initSystem() {
		$forms_path = __DIR__ . '/Forms';
		
		// Don't want to include the title of the content in the URL
		// in case we send urls out via email, so override the default.
		elgg_register_entity_url_handler('object', 'blog', function(ElggBlog $blog) {
			return "/blog/view/$blog->guid";
		});
		
		elgg_register_entity_url_handler('object', 'image', function(TidypicsImage $image) {
			$album = $image->getContainerEntity();
			return "/photos/$album->guid/$image->guid";
		});
		
		/**
		 * Prevent sending email notifications. True indicates we've "handled" the notifications.
		 * This is necessary because tidypics calls object_notifications directly.
		 */
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