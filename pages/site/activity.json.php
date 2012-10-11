<?php
// URL: /:guid/activity.json

header("Content-type: application/json");

$objects = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'blog',
));

$collection_json = array(
	'totalItems' => null,
	'items' => array()
);

foreach ($objects as $object) {
	
	$item = new ElggRiverItem();
	$item->action_type = 'create';
	$item->type = $object->getType();
	$item->subtype = $object->getSubtype();
	$item->object_guid = $object->guid;
	$item->subject_guid = $object->owner_guid;

	$activity_json = array(
		'published' => to_atom($object->time_created),
		'title' => elgg_view('river/elements/summary', array('item' => $item)),
		'actor' => elgg_get_person_proto($object->getOwnerEntity()),
		'object' => elgg_get_object_proto($object),
	);
	
	$collection_json['items'][] = $activity_json;
}

echo json_encode($collection_json);
