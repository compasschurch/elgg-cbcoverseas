<?php

if (!elgg_is_logged_in() && (!elgg_get_site_entity()->isPublicPage() || current_page_url() == elgg_get_site_url())) {
	if (!elgg_get_site_entity()->isPublicPage()) {
		register_error(elgg_echo('loggedinrequired'));
	}

	forward('/login');
}

function cbcoverseas_get_posters() {
	$posterUsernames = explode("\n", elgg_get_plugin_setting('posters', 'cbcoverseas'));
	$posters = array();
	foreach ($posterUsernames as $username) {
		$poster = get_user_by_username(trim($username));
		if ($poster) {
			$posters[] = $poster;
		}
	}
	return $posters;
}

elgg_register_event_handler('init', 'system', function() {
	global $EVAN;
	$EVAN->make('Cbcoverseas\Events')->initSystem();
});