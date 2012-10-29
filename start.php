<?php

function cbcoverseas_blog_url_handler($blog) {
  return "/blog/view/$blog->guid";
}

function elgg_get_person_proto(ElggUser $user) {
	return array(
		'guid' => $user->guid,
		'objectType' => 'person',
		'displayName' => $user->name,
		'summary' => $user->briefdescription,
		'image' => array(
			'url' => $user->getIconURL('medium'),
			'width' => 100, // TODO: dynamically determine this from config variables
			'height' => 100, // TODO: ...and this too, of course
		),
		'url' => $user->getURL(),
	);
}

function elgg_get_comment_proto(ElggAnnotation $comment) {
	return array(
		'annotation_id' => $comment->id,
		'author' => elgg_get_person_proto($comment->getOwnerEntity()),
		'content' => $comment->value,
		'published' => to_atom($comment->time_created),
		'canDelete' => $comment->canEdit(),
		'canEdit' => $comment->canEdit(),
		'objectType' => 'comment',
	);
}


function elgg_get_attachment_proto(ElggObject $object) {
	$objectJson = array(
		'guid' => $object->guid,
		"displayName" => $object->title,
		"url" => $object->getURL(),
		"content" => $object->description,
	);

	if ($object->getSubtype() == 'image') {
		$objectJson['image'] = array(
			'url' => $object->getIconURL('small'),
			'width' => 100, // TODO: dynamically determine this from config variables
			'height' => 100, // TODO: ...and this too, of course
		);
		$objectJson['fullImage'] = array(
			'url' => $object->getIconURL('master'),
			'width' => 550, // TODO: dynamically determine this from config variables
			'height' => 550, // TODO: ...and this too, of course
		);
	}
	
	return $objectJson;
}

function elgg_get_object_proto(ElggObject $object) {
	$objectJson = array(
		'guid' => $object->guid,
		"displayName" => $object->title,
		"url" => $object->getURL(),
		"content" => $object->description,
		'hasLiked' => !!elgg_get_annotations(array(
			'annotation_name' => 'likes',
			'annotation_owner_guid' => elgg_get_logged_in_user_guid(),
			'guid' => $object->guid,
			'count' => true,
		)),
		"likes" => elgg_get_likes_proto($object),
		"comments" => elgg_get_comments_proto($object),
		'attachments' => array(),
	);
	
	if ($object->getSubtype() == 'album') {
		$photos = elgg_get_entities(array(
			'container_guid' => $object->guid,
			'type' => 'object',
			'subtype' => 'image',
		));
		
		foreach ($photos as $photo) {
			$objectJson['attachments'][] = elgg_get_attachment_proto($photo);
		}
	}
	
	if ($object->getSubtype() == 'tidypics_batch') {
		$photos = $object->getEntitiesFromRelationship('belongs_to_batch', true);
		
		foreach ($photos as $photo) {
			$objectJson['attachments'][] = elgg_get_attachment_proto($photo);
		}
	}
		
	return $objectJson;
}

function elgg_get_likes_proto(ElggEntity $entity) {
	$likes = $entity->getAnnotations('likes', 3);
	$likes_count = elgg_get_annotations(array(
		'annotation_name' => 'likes', 
		'guid' => $entity->guid, 
		'count' => true,
	));
	
	$likes_json = array(
		'totalItems' => $likes_count,
		'items' => array(),
	);

	foreach ($likes as $like) {
		$likes_json['items'][] = elgg_get_person_proto($like->getOwnerEntity());
	}
	
	return $likes_json;
}

function elgg_get_comments_proto(ElggEntity $entity) {
	$comments = $entity->getAnnotations('generic_comment', 3, 0, 'desc');
	$comments_json = array(
		'totalItems' => $entity->countComments(),
		'items' => array(),
	);

	foreach ($comments as $comment) {
		$comments_json['items'][] = elgg_get_comment_proto($comment);
	}

	return $comments_json;
}

function from_atom($timestamp) {
	return date_create_from_format(DateTime::ATOM, $timestamp)->getTimestamp();
}

function to_atom($timestamp) {
	return date_format(date_timestamp_set(date_create(), $timestamp), DateTime::ATOM);
}

/**
 * Prevent sending email notifications. True indicates we've "handled" the notifications.
 */
function cbcoverseas_notifications_handler() {
	return true;
}

function cbcoverseas_get_activity_email_content() {
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
	return "Recent activity on CBC Overseas:

New blogs: $blogs
New photos: $photos

Login here to view them: http://cbcoverseas.org/

Thanks!
---
Email questions or problems to webmaster@cbcoverseas.org.
";

}

function cbcoverseas_daily_digest() {
	$subject = "New activity on CBC Overseas ($date)";
	$content = cbcoverseas_get_activity_email_content();
	if (!$content) {
		return;
	}
	
	$site = elgg_get_site_entity();

	$batch = 50;
	$offset = $batch * (int)date("G");
	$users_to_notify = elgg_get_entities(array(
		'type' => 'user',
		'limit' => $batch, // Respect dreamhost rate limits
		'offset' => $offset,
	));

	foreach ($users_to_notify as $user) {
		elgg_send_email($site->email, $user->email, $subject, $content);
	}
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