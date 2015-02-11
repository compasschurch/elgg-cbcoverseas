<?php
namespace Cbcoverseas;

class Events {
	public function initSystem() {
		elgg_register_plugin_hook_handler('entity:url', 'image', function($hook, $type, $return, $params) {
			$entity = $params['entity'];

			// Don't want to include the title of the content in the URL
			// in case we send urls out via email, so override the default.
			if ($entity instanceof TidypicsImage) {
				$album = $entity->getContainerEntity();
				return "/photos/$album->guid/$entity->guid";
			} else if ($entity instanceof ElggBlog) {
				return "/blog/view/$entity->guid";
			}
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