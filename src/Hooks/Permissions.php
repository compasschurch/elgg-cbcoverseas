<?php

namespace Cbcoverseas\Hooks;

class Permissions {
	
	public function hasPermissionToCreateNewObject($hook, $type, $return, $params) {
		$subtype = $params['subtype'];
		
		switch ($subtype) {
			case 'album':
			case 'blog':
			case 'image':
			case 'thewire':
			case 'tidypics_batch':
				$logged_in = $params['user']->username;
				$approved = explode("\n", elgg_get_plugin_setting('posters', 'cbcoverseas'));
				foreach ($approved as $username) {
					if ($logged_in == trim($username)) {
						return true;
					}
				}
				// TODO(evan): Fix this to include admins
				return false;
			default:
				return NULL;
		}
	}
	
	public function getWriteAcls() {
		return array(
			ACCESS_LOGGED_IN => elgg_echo('LOGGED_IN'),
			ACCESS_PRIVATE => elgg_echo('PRIVATE'),
		);
	}
}