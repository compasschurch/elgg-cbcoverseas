<?php

$title = elgg_echo('page:members:index:title');

// TODO(ewinslow): Make the users explicit (i.e. pick specific ones by username)
// TODO(ewinslow): Move this logic into a page handler?
$users = elgg_get_entities(array('type' => 'user'));

$content = '<ul class="elgg-list elgg-list-bios">';
foreach ($users as $user) {
	$content .= '<li class="elgg-item pvm">' . evan_view_entity('bio', $user) . '</li>';
}
$content .= '</ul>';

$body = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content,
	'filter_override' => '',
));

echo elgg_view_page($title, $body);