<?php

$actions_path = dirname(dirname(__DIR__)) . '/actions';

elgg_register_action('comments/add', "$actions_path/comments/add.php");
elgg_register_action("messages/send", "$actions_path/messages/send.php");


elgg_register_entity_url_handler('object', 'blog', 'missions_blog_url_handler');



elgg_unregister_page_handler('activity');
elgg_unregister_event_handler('create', 'object', 'object_notifications');


