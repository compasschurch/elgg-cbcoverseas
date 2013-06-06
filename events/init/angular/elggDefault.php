<?php

$module = $object;

$module->registerRoutes(array(

	'/activity' => 'site/activity',
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

));
