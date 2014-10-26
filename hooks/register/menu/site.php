<?php
use Evan\Menu;

$menu = new Menu($return);

$menu->unregisterItem('blog');

if (elgg_is_admin_logged_in()) {
	$menu->registerItem('admin', array(
		'href' => '/admin',
		'text' => elgg_echo('admin'),
		'section' => 'settings',
	));
}


if (elgg_is_logged_in()) {
	$unread = (int)messages_count_unread();
	
	$user = elgg_get_logged_in_user_entity();

	$menu->registerItem('messages', array(
		'href' => '/messages/inbox',
		'text' => elgg_echo('messages') . ($unread > 0 ? "<span class='elgg-count'>$unread</span>" : ""),
		'encode_text' => false,
	));
	
	$menu->registerItem('settings', array(
		'href' => "/settings/user/$user->username",
		'text' => elgg_echo('settings'),
		'section' => 'settings',
	));
	
	$menu->registerItem('logout', array(
		'href' => elgg_add_action_tokens_to_url('/action/logout'),
		'text' => elgg_echo('logout'),
		'section' => 'settings',
	));
}
return $menu->getItems();
