<?php

$entity = $params['entity'];

$menu = new EvanMenu($return);

if (can_write_to_container(0, $entity->guid, 'object', 'blog')) {
	$menu->registerItem('blog', array(
		'href' => "/blog/add/$entity->guid",
		'text' => elgg_echo('blog:add'),
	));
}

if (can_write_to_container(0, $entity->guid, 'object', 'image')) {
	$menu->registerItem('photos', array(
		'href' => "/photos/add/$entity->guid",
		'text' => elgg_echo('photos:add'),
	));
}

return $menu->getItems();
