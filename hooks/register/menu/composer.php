<?php

$entity = $params['entity'];

$menu = new EvanMenu($return);

$menu->registerItem('blog', array(
	'href' => "/blog/add/$entity->guid",
	'text' => elgg_echo('blog:add'),
));

$menu->registerItem('photos', array(
	'href' => "/photos/add/$entity->guid",
	'text' => elgg_echo('photos:add'),
));

return $menu->getItems();
