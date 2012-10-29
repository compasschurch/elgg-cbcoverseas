<?php
// URL: /posters.json
header("Content-type: application/json");

$posters = array();

$postersJson = array(
	'totalItems' => null,
	'items' => array(),
	'links' => array(
		'next' => null,
		'prev' => null,
	),
);

$posterUsernames = explode("\n", elgg_get_plugin_setting('posters', 'missions.compasschurch.org'));
foreach ($posterUsernames as $username) {
	$poster = get_user_by_username(trim($username));
	if ($poster) {
		$postersJson['items'][] = elgg_get_person_proto($poster);
	}
}

$postersJson['totalItems'] = count($postersJson['items']);

echo json_encode($postersJson);
