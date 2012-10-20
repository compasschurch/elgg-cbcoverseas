<?php

$actions_path = dirname(dirname(__DIR__)) . '/actions';

// Override the following actions in order to prevent the notification emails from being sent
elgg_register_action('comments/add', "$actions_path/comments/add.php");
elgg_register_action("messages/send", "$actions_path/messages/send.php");
elgg_register_action("likes/add", "$actions_path/likes/add.php");

// Don't want to include the title of the blog in the URL in case we send urls out via email, so override the default.
elgg_register_entity_url_handler('object', 'blog', 'missions_blog_url_handler');

// We override this page using the evan framework method. See routes.php
elgg_unregister_page_handler('activity');

// These help prevent sending of all notifications, email or otherwise.
elgg_unregister_event_handler('create', 'object', 'object_notifications');

// This is necessary because tidypics calls object_notifications directly.
elgg_register_plugin_hook_handler('object:notifications', 'all', 'missions_notifications_handler');

elgg_register_plugin_hook_handler('cron', 'hourly', 'missions_daily_digest');
elgg_extend_view('page/elements/head', 'mobile/viewport');
elgg_extend_view('js/initialize_elgg', 'js/cbcoverseas/initialize_elgg');

// Templates
elgg_register_ajax_view('js/angular/directive/elggRiver/template.html');
elgg_register_ajax_view('js/angular/directive/elggRiverComment/template.html');
elgg_register_ajax_view('js/angular/directive/elggRiverItem/template.html');
elgg_register_ajax_view('js/angular/view/site/activity/template.html');
elgg_register_ajax_view('js/elgg/session.js');

// Javascript modules
elgg_register_simplecache_view('js/activitystreams/Collection');
elgg_register_simplecache_view('js/angular/directive/elggRiver/Controller');
elgg_register_simplecache_view('js/angular/directive/elggRiver/factory');
elgg_register_simplecache_view('js/angular/directive/elggRiverComment/Controller');
elgg_register_simplecache_view('js/angular/directive/elggRiverComment/factory');
elgg_register_simplecache_view('js/angular/directive/elggRiverItem/Controller');
elgg_register_simplecache_view('js/angular/directive/elggRiverItem/factory');
elgg_register_simplecache_view('js/angular/directive/focusOn/factory');
elgg_register_simplecache_view('js/angular/view/site/activity/Controller');
elgg_register_simplecache_view('js/angular/module/Elgg');
elgg_register_simplecache_view('js/elgg/River');
elgg_register_simplecache_view('js/text');


elgg_register_js('requirejs', "//cdnjs.cloudflare.com/ajax/libs/require.js/2.0.6/require.min.js", 'footer');
elgg_register_js('pagedown', "//cdnjs.cloudflare.com/ajax/libs/pagedown/1.0/Markdown.Converter.js", 'footer');
elgg_register_js('moment', "//cdnjs.cloudflare.com/ajax/libs/moment.js/1.7.2/moment.min.js", 'footer');
elgg_register_js('angular', "https://ajax.googleapis.com/ajax/libs/angularjs/1.0.2/angular.min.js", 'footer');
elgg_register_js('angular/module/ngResource', "//ajax.googleapis.com/ajax/libs/angularjs/1.0.2/angular-resource.min.js", 'footer');
elgg_register_js('angular/module/ngSanitize', "//ajax.googleapis.com/ajax/libs/angularjs/1.0.2/angular-sanitize.min.js", 'footer');
elgg_register_js('angular/module/Elgg', elgg_get_simplecache_url('js', 'angular/module/Elgg'), 'footer');
