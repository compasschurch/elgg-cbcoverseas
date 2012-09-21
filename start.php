<?php

function missions_blog_url_handler($blog) {
  return "/blog/view/$blog->guid";
}

/**
 * Prevent sending email notifications. True indicates we've "handled" the notifications.
 */
function missions_notifications_handler() {
	return true;
}

function missions_daily_digest() {
	$batch = 50;
	$offset = $batch * (int)date("G");
	$users_to_notify = elgg_get_entities(array(
		'type' => 'user',
		'limit' => $batch, // Respect dreamhost rate limits
		'offset' => $offset,
	));

	$one_day_ago = strtotime("1 day ago");
	$blogs = elgg_get_entities(array(
		'type' => 'object',
		'subtype' => 'blog',
		'created_time_lower' => $one_day_ago,
		'count' => TRUE,
	));

	$photos = elgg_get_entities(array(
		'type' => 'object',
		'subtype' => 'image',
		'created_time_lower' => $one_day_ago,
		'count' => TRUE,
	));

	if ($blogs + $photos <= 0) {
		return;
	}

	$date = date("M j, Y");
	$subject = "New activity on CBC Overseas ($date)";
	$content = "Recent activity on CBC Overseas:

New blogs: $blogs
New photos: $photos

Login here to view them: http://cbcoverseas.org/

Thanks!
---
Email questions or problems to webmaster@cbcoverseas.org.
";

	$site = elgg_get_site_entity();

	foreach ($users_to_notify as $user) {
		elgg_send_email($site->email, $user->email, $subject, $content);
	}
}

