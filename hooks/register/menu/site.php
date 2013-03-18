<?php

$menu = new EvanMenu($return);

$menu->unregisterItem('blog');
$menu->unregisterItem('thewire');

$menu->registerItem('admin', array(
	'href' => '/admin',
	'text' => elgg_echo('admin'),
	'section' => 'settings',
));

$menu->registerItem('messages', array(
	'href' => '/messages/inbox',
	'text' => elgg_echo('messages'),
));

return $menu->getItems();
