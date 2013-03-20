<?php

$menu = new EvanMenu($return);

$menu->unregisterItem('blog');
$menu->unregisterItem('thewire');

if (elgg_is_admin_logged_in()) {
	$menu->registerItem('admin', array(
		'href' => '/admin',
		'text' => elgg_echo('admin'),
		'section' => 'settings',
	));
}

$unread = (int)messages_count_unread();

if (elgg_is_logged_in()) {
	$menu->registerItem('messages', array(
		'href' => '/messages/inbox',
		'text' => elgg_echo('messages') . ($unread > 0 ? "<span class='elgg-count'>$unread</span>" : ""),
		'encode_text' => false,
	));
	
	$menu->registerItem('settings', array(
		'href' => '/settings',
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
