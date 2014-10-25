<?php

global $EVAN;

// Limit on number of users to respect hosting rate limits.
$usersPerHour = 50;
$emailFactory = new \Cbcoverseas\Digest\EmailFactory(
    $EVAN->clock, elgg_get_site_entity(), $EVAN->views, $EVAN->db, $EVAN->i18n);

$users = $emailFactory->getUsers($usersPerHour);

foreach ($users as $user) {
	$email = $emailFactory->createForUser($user);
	if ($email) {
		$EVAN->mailer->send($email);
	}
}
