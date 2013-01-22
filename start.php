<?php

global $EVAN;

if (!$EVAN) {
    $EVAN = new stdClass;
}

$EVAN->mailer = new Evan_Email_ElggSender();
$EVAN->clock = new Evan_SystemClock();
$EVAN->db = new Evan_Db_Mysql();

$EVAN->views = new Evan_ViewService();
$EVAN->i18n = new Evan_I18n();

function cbcoverseas_blog_url_handler(ElggBlog $blog) {
  return "/blog/view/$blog->guid";
}

function elgg_get_person_proto(ElggUser $user) {
	$person = array(
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
		'location' => array(
			'displayName' => $user->location,
		),
		'username' => $user->username,
	);
	
	if (elgg_is_admin_logged_in()) {
		$person['published'] = to_atom($user->time_created);
		$person['banned'] = $user->isBanned();
		$person['ban_reason'] = $user->ban_reason;
		$person['email'] = $user->email;
		
		if ($user->last_action) {
			$person['last_action'] = to_atom($user->last_action);
		}
	}
	
	return $person;
}

function elgg_get_comment_proto(ElggAnnotation $comment) {
	$commentJson = array(
		'annotation_id' => $comment->id,
		'content' => $comment->value,
		'published' => to_atom($comment->time_created),
		'canDelete' => $comment->canEdit(),
		'canEdit' => $comment->canEdit(),
		'objectType' => 'comment',
	);
	
	$owner = $comment->getOwnerEntity();
	if ($owner) {
		$commentJson['author'] = elgg_get_person_proto($owner);
	}
	
	return $commentJson;
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
		'published' => to_atom($object->time_created),
		'updated' => to_atom($object->time_updated),
		"displayName" => $object->title,
		"url" => $object->getURL(),
		"content" => $object->description,
		'canEdit' => $object->canEdit(),
		'canDelete' => $object->canEdit(),
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
	
	$owner = $object->getOwnerEntity();
	if ($owner) {
		$objectJson['author'] = elgg_get_person_proto($owner);
	}


	if ($object->getSubtype() == 'album') {
		$photosOptions = array(
                        'container_guid' => $object->guid,
                        'type' => 'object',
                        'subtype' => 'image',
                );

		$photos = elgg_get_entities($photosOptions);

		$objectJson['totalItems'] = $object->getSize();
	
		$coverImage = get_entity($object->getCoverImageGuid());
		if ($coverImage) {
			$objectJson['image'] = array(
				'url' => $coverImage->getIconUrl('small'),
			);
		} else {
			$objectJson['image'] = array(
				'url' => elgg_normalize_url("mod/tidypics/graphics/empty_album.png"),
			);
		}

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

function elgg_get_plugin_proto(ElggPlugin $plugin) {
	$pluginJson = array(
		'guid' => $plugin->guid,
		'version' => $plugin->version,
		'displayName' => $plugin->title,
		'elggPluginId' => $plugin->getId(),
		'isActive' => $plugin->isActive(),
	);
	
	return $pluginJson;
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
