<?php

if (!elgg_is_logged_in() && (!elgg_get_site_entity()->isPublicPage() || current_page_url() == elgg_get_site_url())) {
	if (!elgg_get_site_entity()->isPublicPage()) {
		register_error(elgg_echo('loggedinrequired'));
	}

	forward('/login');
}

function cbcoverseas_blog_url_handler(ElggBlog $blog) {
  return "/blog/view/$blog->guid";
}

function cbcoverseas_image_url_handler(TidypicsImage $image) {
	$album = $image->getContainerEntity();
	$title = elgg_get_friendly_title($image->getTitle());
	return "/photos/$album->guid/$image->guid/$title";
}

/**
 * Prevent sending email notifications. True indicates we've "handled" the notifications.
 */
function cbcoverseas_notifications_handler() {
	return true;
}

function cbcoverseas_get_posters() {
	$posterUsernames = explode("\n", elgg_get_plugin_setting('posters', 'cbcoverseas'));
	$posters = array();
	foreach ($posterUsernames as $username) {
		$poster = get_user_by_username(trim($username));
		if ($poster) {
			$posters[] = $poster;
		}
	}
	return $posters;
}
