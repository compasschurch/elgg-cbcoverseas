<?php

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
		return false;
	default:
		return NULL;
}
