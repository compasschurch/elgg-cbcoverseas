<?php

$actions_path = dirname(dirname(__DIR__)) . '/actions';

elgg_register_admin_menu_item('administer', 'browse', 'users', 1);

// Override the following actions in order to prevent the notification emails from being sent
// TODO: Override thn
elgg_register_action("messages/send", "$actions_path/messages/send.php");
elgg_register_action("likes/add", "$actions_path/likes/add.php");

// Don't want to include the title of the blog in the URL in case we send urls out via email, so override the default.
elgg_register_entity_url_handler('object', 'blog', 'cbcoverseas_blog_url_handler');
elgg_register_entity_url_handler('object', 'image', 'cbcoverseas_image_url_handler');

// We override this page using the evan framework method. See routes.php
elgg_unregister_page_handler('activity');
elgg_unregister_page_handler('thewire');

// These help prevent sending of all notifications, email or otherwise.
elgg_unregister_event_handler('create', 'object', 'object_notifications');

// That Elgg logo in the upper left is annoying...
elgg_unregister_menu_item('topbar', 'elgg_logo');

// This is necessary because tidypics calls object_notifications directly.
elgg_register_plugin_hook_handler('object:notifications', 'all', 'cbcoverseas_notifications_handler');

elgg_extend_view('page/elements/head', 'mobile/viewport');
elgg_extend_view('page/elements/head', 'cbc/head', 1);
elgg_extend_view('js/initialize_elgg', 'js/cbcoverseas/initialize_elgg');
elgg_extend_view('css/admin', 'cbc/admin.css');

elgg_unextend_view('page/elements/header', 'search/search_box');

global $CBC;
$CBC = new stdClass;

elgg_register_ajax_view('js/elgg/session.js');
elgg_register_ajax_view('page/elements/sidebar');

if (elgg_is_admin_logged_in()) {
	elgg_register_ajax_view('plugins/cbcoverseas/settings');
}