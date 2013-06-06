<?php

$actions_path = dirname(dirname(__DIR__)) . '/actions';

elgg_register_admin_menu_item('administer', 'browse', 'users', 1);

// Override the following actions in order to prevent the notification emails from being sent
elgg_register_action('comments/add', "$actions_path/comments/add.php");
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
elgg_extend_view('css/admin', 'cbc/css/admin');

elgg_unextend_view('page/elements/header', 'search/search_box');

global $CBC;
$CBC = new stdClass;

$CBC->modules = array(
	'activitystreams/Collection',
	'angular/module/Elgg',
	'angular/module/elggAdmin',
	'angular/module/elggDefault',
	'cbc/Overseas',
	'elgg/Database',
	'text',
	'jquery/tinymce',
);

$CBC->templates = array();

$CBC->views = array(
	'/blog/add/:container_guid' => 'blog/add',
	'/blog/edit/:guid' => 'blog/edit',
	'/blog/view/:guid' => 'blog/view',
	// '/messages/inbox/:username' => 'messages/inbox',
	// '/messages/read/:guid' => 'messages/view',
	// '/messages/sent/:evan' => 'messages/sent',
	'/photos/add/:container_guid' => 'photos/add',
	'/photos/all' => 'photos/all',
	'/photos/album/:guid/:title' => 'photos/album',
	'/photos/image/:guid/:title' => 'photos/image',
	'/photos/owner/:alias' => 'photos/owner',
	// '/profile/:username' => 'user/view',
	'/activity' => 'site/activity',
);

foreach ($CBC->views as $view) {
	$CBC->templates[] = "js/angular/view/$view/template.html";
	$CBC->modules[] = "angular/view/$view/Controller";
	$CBC->modules[] = "angular/view/$view/route";
}

$CBC->directives = array(
	'cbcPosters',
	'elggFocusModel',
	'elggFormBlogSave',
	'elggInputHtml',
	'elggResponses',
	'elggRiver',
	'elggRiverComment',
	'elggRiverItem',
	'elggUsers',
	'whenScrolled',
);

foreach ($CBC->directives as $directive) {
	$CBC->templates[] = "js/angular/directive/$directive/template.html";
	$CBC->modules[] = "angular/directive/$directive/Controller";
	$CBC->modules[] = "angular/directive/$directive/factory";
}

$CBC->filters = array(
	'elggEcho',
);

foreach ($CBC->filters as $filter) {
	$CBC->modules[] = "angular/filter/$filter";
}

foreach ($CBC->templates as $template) {
	elgg_register_ajax_view($template);
}

foreach ($CBC->modules as $module) {
	elgg_register_simplecache_view("js/$module");
}

elgg_register_ajax_view('js/elgg/session.js');
elgg_register_ajax_view('page/elements/sidebar');

if (elgg_is_admin_logged_in()) {
	elgg_register_ajax_view('plugins/cbcoverseas/settings');
}

