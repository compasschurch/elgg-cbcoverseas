<?php

$actions_path = dirname(dirname(__DIR__)) . '/actions';

// Override the following actions in order to prevent the notification emails from being sent
// TODO: Override thn
elgg_register_action("messages/send", "$actions_path/messages/send.php");
elgg_register_action("likes/add", "$actions_path/likes/add.php");

// Don't want to include the title of the blog in the URL in case we send urls out via email, so override the default.
elgg_register_entity_url_handler('object', 'blog', 'cbcoverseas_blog_url_handler');
elgg_register_entity_url_handler('object', 'image', 'cbcoverseas_image_url_handler');

// These help prevent sending of all notifications, email or otherwise.
elgg_unregister_event_handler('create', 'object', 'object_notifications');

// This is necessary because tidypics calls object_notifications directly.
elgg_register_plugin_hook_handler('object:notifications', 'all', 'cbcoverseas_notifications_handler');
