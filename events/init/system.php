<?php

elgg_register_page_handler('teams', 'cbc_amman_team_page_handler');

elgg_register_menu_item('site', array(
	'name' => 'members',
	'href' => '/teams',
	'text' => elgg_echo('cbc:teams'),
));

elgg_register_menu_item('site', array(
	'name' => 'blog',
	'href' => '/blog',
	'text' => elgg_echo('page:blog:index:title'),
));

function cbc_amman_team_page_handler() {
	echo elgg_view('page/members/index');
}
