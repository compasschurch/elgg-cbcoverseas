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
