<?php

$entity = $vars['entity'];

echo elgg_view('output/url', array(
	'text' => isset($entity->name) ? $entity->name : $entity->title,
	'href' => $entity->getUrl(),
	'encode_text' => true,
	'is_trusted' => true,
));