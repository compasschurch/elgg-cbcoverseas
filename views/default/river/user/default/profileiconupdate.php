<?php
/**
 * Update avatar river view
 */

$subject = $vars['item']->getSubjectEntity();

$subject_link = evan_view_entity('link', $subject, array(
	'class' => 'elgg-river-subject',
));

$string = elgg_echo('river:update:user:avatar', array($subject_link));

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'summary' => $string,
	'attachments' => evan_view_entity('icon', $subject, array(
		'size' => 'medium',
		'use_hover' => false,
		'use_link' => false,
	)),
));
