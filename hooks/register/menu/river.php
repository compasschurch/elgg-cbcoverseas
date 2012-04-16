<?php

$menu = new EvanMenu($return);

$menu->unregisterItem('likes');

if (elgg_is_logged_in()) {
	
	// The river item
	$item = $params['item'];
	
	// only like group creation #3958
	if ($item->type == "group" && $item->view != "river/group/create") {
		return $return;
	}
	
	// don't like users #4116
	if ($item->type == "user") {
		return $return;
	}
	
	$object = $item->getObjectEntity();
	if (!elgg_in_context('widgets') && $item->annotation_id == 0) {
		if ($object->canAnnotate(0, 'likes')) {
			if (!elgg_annotation_exists($object->guid, 'likes')) {
				$menu->registerItem('like', array(
					'href' => elgg_add_action_tokens_to_url("/action/likes/add?guid={$object->guid}"),
					'text' => elgg_view_icon('thumbs-up'),
					'title' => elgg_echo('likes:likethis'),
				));
			} else {
				$menu->registerItem('unlike', array(
					'href' => elgg_add_action_tokens_to_url("/action/likes/delete?guid={$object->guid}"),
					'text' => elgg_view_icon('thumbs-up-alt'),
					'title' => elgg_echo('likes:remove'),
				));
			}
		}
		
		$num_of_likes = likes_count($object);
		
		if ($num_of_likes) {
			$text = $num_of_likes == 1 ? 'likes:user' : 'likes:users';
			$menu->registerItem('likes_count', array(
				'href' => false,
				'priority' => 101,
				'text' => elgg_echo($text . 'likedthis', array($num_of_likes)),
				'title' => elgg_echo('likes:see'),
			));
		}
	}
}

return $menu->getItems();