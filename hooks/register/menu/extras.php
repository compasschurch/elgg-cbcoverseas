<?php
use Evan\Menu;


$menu = new Menu($return);

// Remove this when http://trac.elgg.org/ticket/4444 is fixed.
$menu->unregisterItem('rss');

return $menu->getItems();
