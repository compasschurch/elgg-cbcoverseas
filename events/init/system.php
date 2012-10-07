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
elgg_register_simplecache_view('js/angular/module/Elgg');

elgg_register_ajax_view('js/angular/directive/elggRiverComment/template.html');
elgg_register_ajax_view('js/angular/directive/elggRiverItem/template.html');
elgg_register_ajax_view('js/angular/view/site/activity/template.html');

elgg_register_js('showdown', "https://raw.github.com/coreyti/showdown/3b9b743f90d4c808f50b54e0c5d408a7ac050704/compressed/showdown.js", 'footer');
elgg_register_js('moment', "https://raw.github.com/timrwood/moment/1.7.2/min/moment.min.js", 'footer');
elgg_register_js('angular', "https://ajax.googleapis.com/ajax/libs/angularjs/1.0.2/angular.min.js", 'footer');
elgg_register_js('angular/module/ngResource', "//ajax.googleapis.com/ajax/libs/angularjs/1.0.2/angular-resource.min.js", 'footer');
elgg_register_js('angular/module/ngSanitize', "//ajax.googleapis.com/ajax/libs/angularjs/1.0.2/angular-sanitize.min.js", 'footer');
elgg_register_js('angular/module/Elgg', elgg_get_simplecache_url('js', 'angular/module/Elgg'), 'footer');