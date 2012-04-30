<?php

elgg_register_entity_url_handler('object', 'blog', 'missions_blog_url_handler');

elgg_register_action('comments/add', dirname(dirname(__DIR__)) . '/actions/comments/add.php');
elgg_unregister_page_handler('activity');

