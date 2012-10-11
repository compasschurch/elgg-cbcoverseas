<?php

$subtype = $params['subtype'];

switch ($subtype) {
	case 'blog':
	case 'image':
	case 'album':
		$logged_in = $params['user']->username;
		$approved = explode("\n", elgg_get_plugin_setting('posters', 'missions.compasschurch.org'));
		foreach ($approved as $username) {
			if ($logged_in == trim($username)) {
				return true;
			}
		}
		return false;
	default:
		return NULL;
}
