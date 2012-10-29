<?php

$menu = new EvanMenu($return);

$menu->unregisterItem('blog');
$menu->unregisterItem('thewire');

return $menu->getItems();