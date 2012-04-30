<?php

function missions_blog_url_handler($blog) {
  return "/blog/view/$blog->guid";
}

elgg_unregister_event_handler('create', 'object', 'object_notifications');
