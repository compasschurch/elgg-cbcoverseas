<?php

namespace Cbcoverseas\Hooks;

class Cron {
	public function sendBatchOfEmailDigests() {
		global $EVAN;

		// Limit on number of users to respect hosting rate limits.
		$usersPerHour = 50;
		$emailFactory = $EVAN->get('Cbcoverseas\Digest\EmailFactory');
		
		$users = $emailFactory->getUsers($usersPerHour);
		
		foreach ($users as $user) {
			$email = $emailFactory->createForUser($user);
			if ($email) {
				$EVAN->get('Evan\Email\Sender')->send($email);
			}
		}
	}
}