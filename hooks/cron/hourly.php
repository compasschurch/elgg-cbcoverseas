<?php

global $EVAN;

// Limit on number of users to respect hosting rate limits.
$usersPerHour = 50;
$emailFactory = $EVAN->get('Cbcoverseas\Digest\EmailFactory');

$users = $emailFactory->getUsers($usersPerHour);

foreach ($users as $user) {
	$email = $emailFactory->createForUser($user);
	if ($email) {
		$EVAN->mailer->send($email);
	}
}
