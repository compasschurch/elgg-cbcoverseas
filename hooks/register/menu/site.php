<?php

$menu = new EvanMenu($return);

$menu->unregisterItem('blog');

return $menu->getItems();